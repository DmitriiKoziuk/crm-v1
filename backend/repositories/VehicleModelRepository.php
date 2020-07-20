<?php declare(strict_types=1);

namespace backend\repositories;

use backend\models\Model;

class VehicleModelRepository
{
    /**
     * @param int $brandId
     * @return Model[]
     */
    public function getModels(int $brandId): array
    {
        /** @var Model[] $models */
        $models = Model::find()->where(['brand_id' => $brandId])->all();
        return $models;
    }
}
