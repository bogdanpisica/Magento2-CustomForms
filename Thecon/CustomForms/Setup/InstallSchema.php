<?php

namespace Thecon\CustomForms\Setup;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{

	public function install(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('th_form_solicitare')) {
			/*TABELA SOLICITARI*/
			$table = $installer->getConnection()->newTable(
				$installer->getTable('th_form_solicitare')
			)
				->addColumn(
					'entity_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'ID'
				)
				->addColumn(
					'nume_firma',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Nume firma'
				)
				->addColumn(
					'localitate_sediu',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Localitate sediu'
				)
				->addColumn(
					'nume_reprezentant',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Nume reprezentant'
				)
				->addColumn(
					'specific_vanzare',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Specific Vanzare'
				)
				->addColumn(
					'telefon',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Telefon contact'
				)
				->addColumn(
					'email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Adresa email'
				)
				->setComment('Form solicitare');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('th_form_solicitare'),
				$setup->getIdxName(
					$installer->getTable('th_form_solicitare'),
					['nume_firma', 'localitate_sediu', 'nume_reprezentant', 'specific_vanzare', 'telefon', 'email'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['nume_firma', 'localitate_sediu', 'nume_reprezentant', 'specific_vanzare', 'telefon', 'email'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}

		if (!$installer->tableExists('th_form_oferta')) {
			/*TABELA OFERTA*/
			$table = $installer->getConnection()->newTable(
				$installer->getTable('th_form_oferta')
			)
				->addColumn(
					'entity_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'ID'
				)
				->addColumn(
					'nume_prenume',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					['nullable => false'],
					'Nume si prenume'
				)
				->addColumn(
					'telefon',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Telefon contact'
				)
				->addColumn(
					'email',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					255,
					[],
					'Adresa email'
				)
				->addColumn(
					'mesaj',
					\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
					2000,
					[],
					'Mesaj'
				)
				->setComment('Form oferta');
			$installer->getConnection()->createTable($table);

			$installer->getConnection()->addIndex(
				$installer->getTable('th_form_oferta'),
				$setup->getIdxName(
					$installer->getTable('th_form_oferta'),
					['nume_prenume', 'telefon', 'email', 'mesaj'],
					\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
				),
				['nume_prenume', 'telefon', 'email', 'mesaj'],
				\Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
			);
		}
		$installer->endSetup();
	}
}