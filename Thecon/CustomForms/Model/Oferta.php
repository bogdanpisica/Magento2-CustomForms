<?php
namespace Thecon\CustomForms\Model;

use Thecon\CustomForms\Api\Data\OfertaInterface;

class Oferta extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'th_form_oferta';

    protected $_cacheTag = 'th_form_oferta';

    protected $_eventPrefix = 'th_form_oferta';

    protected function _construct()
    {
        $this->_init('Thecon\CustomForms\Model\ResourceModel\Oferta');
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function getNumePrenume()
    {
        return $this->getData(self::NUME_PRENUME);
    }

    public function setNumePrenume($nume_prenume)
    {
        return $this->setData(self::NUME_PRENUME, $nume_prenume);
    }

    public function getTelefon()
    {
        return $this->getData(self::TELEFON);
    }

    public function setTelefon($telefon)
    {
        return $this->setData(self::TELEFON, $telefon);
    }

    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    public function getMesaj()
    {
        return $this->getData(self::MESAJ);
    }

    public function setMesaj($mesaj)
    {
        return $this->setData(self::MESAJ, $mesaj);
    }
}
