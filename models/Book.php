<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $image_uri
 * @property string $edition
 * @property integer $id_original
 *
 * @property Book $idOriginal
 * @property Book[] $books
 * @property BookAuthor $bookAuthor
 * @property Author[] $idAuthors
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['description'], 'string'],
            [['id_original'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['image_uri'], 'string', 'max' => 500],
            [['edition'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Título'),
            'description' => Yii::t('app', 'Descripción'),
            'image_uri' => Yii::t('app', 'Imagen'),
            'edition' => Yii::t('app', 'Edición'),
            'id_original' => Yii::t('app', 'Libro original'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOriginal()
    {
        return $this->hasOne(Book::className(), ['id' => 'id_original']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id_original' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAuthor()
    {
        return $this->hasOne(BookAuthor::className(), ['id_book' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuthors()
    {
        return $this->hasMany(Author::className(), ['id' => 'id_author'])->viaTable('book_author', ['id_book' => 'id']);
    }
}
