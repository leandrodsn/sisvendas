<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

class Venda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ven_venda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valor_total', 'created_at', 'ven_funcionario_id'], 'required'],
            [['valor_total'], 'salfe'],
            [['created_at', 'ven_funcionario_id'], 'integer'],
            [['ven_funcionario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionario::className(), 'targetAttribute' => ['ven_funcionario_id' => 'id']],
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor_total' => 'Valor Total',
            'created_at' => 'Create Em',
            'ven_funcionario_id' => 'Funcionario',
        ];
    }

    /**
     * Gets query for [[VenFuncionario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuncionario()
    {
        return $this->hasOne(VenFuncionario::className(), ['id' => 'ven_funcionario_id']);
    }

    /**
     * Gets query for [[VenProdutos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdutos()
    {
        return $this->hasMany(Produto::className(), ['id' => 'ven_produto_id'])->viaTable('ven_venda_ven_produto', ['ven_venda_id' => 'id']);
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

        $query->andFilterWhere(['ven_funcionario_id', $this->ven_funcionario_id]);

        return $dataProvider;
    }
}
