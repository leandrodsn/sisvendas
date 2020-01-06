<?php

namespace app\models;

use Yii;

class VendaModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['total'], 'required'],
            [['total'], 'number'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoVendas()
    {
        return $this->hasMany(ProdutoVenda::className(), ['venda_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['id' => 'produto_id'])->viaTable('produto_has_venda', ['venda_id' => 'id']);
    }
}
