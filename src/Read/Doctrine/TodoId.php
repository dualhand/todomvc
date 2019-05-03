<?php

namespace App\Read\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use App\Write\Model\TodoId as Id;

class TodoId extends StringType
{
    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return Barcode|mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $serializedString = parent::convertToPHPValue($value, $platform);

        return Id::fromString($serializedString);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->toString();
    }


    public function getName()
    {
        return 'todo_id';
    }
}
