<?php
namespace Thecon\CustomForms\Api\Data;

interface SolicitareInterface
{
    const ENTITY_ID = 'entity_id';
    const NUME_FIRMA = 'nume_firma';
    const LOCALITATE_SEDIU = 'localitate_sediu';
    const NUME_REPREZENTANT = 'nume_reprezentant';
    const TELEFON = 'telefon';
    const EMAIL = 'email';
    const SPECIFIC_VANZARE = 'specific_vanzare';

    public function getEntityId();
    public function setEntityId($entityId);

    public function getNumeFirma();
    public function setNumeFirma($nume_firma);

    public function getLocalitateSediu();
    public function setLocalitateSediu($localitate_sediu);

    public function getNumeReprezentant();
    public function setNumeReprezentant($nume_reprezentant);

    public function getTelefon();
    public function setTelefon($telefon);

    public function getEmail();
    public function setEmail($email);

    public function getSpecificVanzare();
    public function setSpecificVanzare($specific_vanzare);
}
