<?php
namespace Thecon\CustomForms\Model;

use Thecon\CustomForms\Api\Data\SolicitareInterface;

class Solicitare extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'th_form_solicitare';

    protected $_cacheTag = 'th_form_solicitare';

    protected $_eventPrefix = 'th_form_solicitare';

    protected function _construct()
    {
        $this->_init('Thecon\CustomForms\Model\ResourceModel\Solicitare');
    }

    public function getEntityId()
    {
        return $this->getData('entity_id');
    }

    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    public function getNumeFirma()
    {
        return $this->getData(self::NUME_FIRMA);
    }

    public function setNumeFirma($nume_firma)
    {
        return $this->setData(self::NUME_FIRMA, $nume_firma);
    }

    public function getLocalitateSediu()
    {
        return $this->getData(self::LOCALITATE_SEDIU);
    }

    public function setLocalitateSediu($localitate_sediu)
    {
        return $this->setData(self::LOCALITATE_SEDIU, $localitate_sediu);
    }

    public function getNumeReprezentant()
    {
        return $this->getData(self::NUME_REPREZENTANT);
    }

    public function setNumeReprezentant($nume_reprezentant)
    {
        return $this->setData(self::NUME_REPREZENTANT, $nume_reprezentant);
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

    public function getSpecificVanzare()
    {
        return $this->getData(self::SPECIFIC_VANZARE);
    }

    public function setSpecificVanzare($specific_vanzare)
    {
        return $this->setData(self::SPECIFIC_VANZARE, $specific_vanzare);
    }
}
