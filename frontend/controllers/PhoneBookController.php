<?php

namespace frontend\controllers;

use core\forms\PhoneBookForm;
use core\forms\PhoneForm;
use core\services\PhoneBookService;
use Yii;
use core\entities\PhoneBook;
use core\forms\search\PhoneBookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhoneBookController implements the CRUD actions for PhoneBook model.
 */
class PhoneBookController extends Controller
{
    private $service;

    public function __construct(
        $id,
        $module,
        PhoneBookService $service,
        $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhoneBook models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhoneBookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        $resArray = [];
        $arrSter = [123,234,4565,567];
        foreach ($arrSter as $item) {
            $resArray[] = $item;
        }


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhoneBook model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PhoneBook model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new PhoneBookForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $phoneBook = $this->service->create($form);
                Yii::$app->session->setFlash('success', 'создали');
                return $this->redirect(['view', 'id' => $phoneBook->id]);
            }catch (\DomainException $e){
                Yii::$app->session->setFlash('error',$e->getMessage());
            }

        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing PhoneBook model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $phoneBook = $this->findModel($id);

        $form = new PhoneBookForm($phoneBook);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->update($form, $phoneBook->id);
                Yii::$app->session->setFlash('success', 'создали');
                return $this->redirect(['view', 'id' => $phoneBook->id]);
            }catch (\DomainException $e)
            {
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing PhoneBook model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->service->remove($id);
            Yii::$app->session->setFlash('success','remove success');
        }catch (\RuntimeException $e) {
            Yii::$app->session->setFlash('error',$e->getMessage());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhoneBook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhoneBook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhoneBook::find()->with('phones')->where(['id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
