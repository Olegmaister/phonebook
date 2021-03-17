<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel core\forms\search\PhoneBookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phone Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phone-book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Phone Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'first_name',
            'last_name',
            'email:email',
            'date_birth',
            [
                'attribute' => 'phone',
                'value' => function(\core\entities\PhoneBook $phoneBook){
                    return  $phoneBook->getListPhones();
                },
                'format' => 'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
