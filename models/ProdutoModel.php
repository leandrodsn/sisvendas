<?php

namespace app\models;

use Yii;

class ProdutoModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descricao', 'preco'], 'required'],
            [['preco'], 'number'],
            [['preco'], 'safe'],
            [['descricao'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Descricao',
            'preco' => 'Preco',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdutoHasVendas()
    {
        return $this->hasMany(ProdutoVenda::className(), ['produto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(VendaModel::className(), ['id' => 'venda_id'])->viaTable('produto_has_venda', ['produto_id' => 'id']);
    }
}
