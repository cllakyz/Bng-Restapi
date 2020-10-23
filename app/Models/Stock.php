<?php


namespace App\Models;

use App\Core\DbModel;

/**
 * Class Stock
 *
 * @author Celal Akyüz <cllakyz@hotmail.com>
 * @package App\Models
 */
class Stock extends DbModel
{
    /** Class variables */
    public $product_id = '';
    public $name = '';
    public $stock = 0;
    public $created_date = '';

    /**
     * Table name
     * @return string
     */
    public function tableName(): string
    {
        return "stocks";
    }

    /**
     * Model attributes
     * @return string[]
     */
    public function attributes(): array
    {
        return ['product_id', 'name', 'stock'];
    }

    /**
     * Save func.
     * @return string
     */
    public function save()
    {
        return $this->insert();
    }

    /**
     * Stock list
     * @param array $where
     * @return array
     */
    public function stockList(array $where = [])
    {
        return$this->find($where);
    }

    /**
     * Stok find one by id
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        return $this->findOne(['id' => $id]);
    }

    /**
     * Set model rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED],
            'stock' => [self::RULE_REQUIRED]
        ];
    }
}