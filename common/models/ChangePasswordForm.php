<?php
namespace common\models;
 
use Yii;
use yii\base\InvalidParamException;
use yii\base\Model;
use common\models\User;
 
/**
 * Change password form for current user only
 */
class ChangePasswordForm extends Model
{
	public $id;
	public $old_password;
	public $new_password;
	public $confirm_password;
 
	/**
	 * @var \common\models\User
	 */
	private $_user;
 
	/**
	 * Creates a form model given a token.
	 *
	 * @param  string                          $token
	 * @param  array                           $config name-value pairs that will be used to initialize the object properties
	 * @throws \yii\base\InvalidParamException if token is empty or not valid
	 */
	public function __construct($id, $config = [])
	{
		$this->_user = User::findIdentity($id);
		
		if (!$this->_user) {
			throw new InvalidParamException('Unable to find user!');
		}
		
		$this->id = $this->_user->id;
		parent::__construct($config);
	}
 
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['old_password', 'new_password','confirm_password'], 'required'],
			[['old_password', 'new_password','confirm_password'], 'string', 'min' => 6],
			['old_password','validatePassword'],
			['confirm_password', 'compare', 'compareAttribute' => 'new_password'],
		];
	}
 
	/**
	 * Changes password.
	 *
	 * @return boolean if new_password was changed.
	 */
	public function changePassword()
	{
		$user = $this->_user;
		$user->setPassword($this->new_password);
 
		return $user->save(false);
	}
	
	public function validatePassword()
    {
        /* @var $user User */
        $user = Yii::$app->user->identity;
        if (!$user || !$user->validatePassword($this->old_password)) {
            $this->addError('old_password', 'Incorrect old password.');
        }
    }
}
?>