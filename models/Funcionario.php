<?php

namespace app\models;

use Yii;
use yiibr\brvalidator\CpfValidator;
use miserenkov\validators\PhoneValidator;
use yii\data\ActiveDataProvider;

class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ven_funcionario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cpf', 'tel'], 'required', 'except' => 'search'],
            [['name'], 'string', 'max' => 150],
            [['cpf'], CpfValidator::className()],
            [['tel'], PhoneValidator::className()]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cpf' => 'Cpf',
            'tel' => 'Tel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenVendas()
    {
        return $this->hasMany(Venda::className(), ['ven_funcionario_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     * 
     * @param array $params
     * 
     * @return ActiveDataProvider
     * **/
    public function search($params)
    {
        $query = self::find();

        //add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if(!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //grid filtering conditions
        $query->andFilterWhere([
            'id'=>$this->id
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

}