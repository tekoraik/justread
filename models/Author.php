<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $nombre
 *
 * @property BookAuthor $bookAuthor
 * @property Book[] $idBooks
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 120],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthor()
    {
        return $this->hasOne(BookAuthor::className(), ['id_author' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'id_book'])->viaTable('book_author', ['id_author' => 'id']);
    }
}
