<?php declare(strict_types=1);

namespace backend\repositories;

use backend\models\Brand;

class VehicleBrandRepository
{
    /**
     * @return Brand[]
     */
    public function getAll(): array
    {
        /** @var Brand[] $brands */
        $brands = Brand::find()->all();
        return $brands;
    }
}
