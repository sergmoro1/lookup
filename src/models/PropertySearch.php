<?php
namespace sergmoro1\lookup\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class PropertySearch extends PropertyEdit
{
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            ['id', 'integer'],
            ['name', 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = PropertyEdit::find()->where('id >= ' . PropertyEdit::BARRIER);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => \Yii::$app->params['recordsPerPage'],
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ],
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        // adjust the query by adding the filters
        $query->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['name' => $this->name]);

        return $dataProvider;
    }
}
