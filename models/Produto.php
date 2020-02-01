<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

class Produto extends \yii\db\ActiveRecord 
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ven_produto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'is_available'], 'required', 'except' => 'search'],
            [['data_validade'], 'date'],
            [['is_available'], 'integer'],
            [['price'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {   
        $this->price = floatval(strtr($this->price, [','=>'.']));
        $date =  explode('/', $this->data_validade);
        $this->data_validade = $date[2].'-'.$date[1].'-'.$date[0];
        return parent::beforeSave($insert);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nome',
            'price' => 'Preço',
            'data_validade' => 'Data de Validade',
            'is_available'  => 'Disponível'
        ];
    }

    /**
     * Gets query for [[VenVendas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendas()
    {
        return $this->hasMany(Venda::className(), ['id' => 'ven_venda_id'])->viaTable('ven_venda_ven_produto', ['ven_produto_id' => 'id']);
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
