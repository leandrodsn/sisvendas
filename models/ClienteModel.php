<?php

namespace app\models;

use Yii;
use yiibr\brvalidator\CpfValidator;


class ClienteModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cpf'], 'required'],
            [['nome'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 45],
            [['email'], 'email'],
            [['cpf'], 'string', 'max' => 14],
            [['cpf'], CpfValidator::className()],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
            'cpf' => 'Cpf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['Cliente_id' => 'id']);
    }
}