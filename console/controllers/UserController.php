<?php
/**
 * Created by PhpStorm.
 * User: lav45
 * Date: 16.9.14
 * Time: 23.29
 */

namespace console\controllers;

use yii\helpers\Console;
use yii\console\Controller;
use yii\console\Exception;
use common\models\User;

/**
 * Users CRUD controller
 *
 * Class UserController
 * @package console\controllers
 */
class UserController extends Controller
{
    /**
     * Show User list
     */
    public function actionIndex()
    {
        /** @var User[] $users */
        $users = User::find()->all();

        $this->stdout("The following users were found in the system:\n\n", Console::FG_YELLOW);

        foreach ($users as $user) {
            $this->stdout("\t* {$user->username}\n", Console::FG_GREEN);
        }

        $this->stdout("\n");
    }

    /**
     * Delete user {username}
     *
     * @throws Exception
     */
    public function actionDelete()
    {
        $username = func_num_args() > 0 ? func_get_arg(0) : $this->getStdIn("Enter username: ");

        $user = $this->findUser($username);

        $user->delete();
        $this->stdout("* {$user->username} was deleted\n", Console::FG_GREEN);
    }

    /**
     * Create new user {username} {password}
     */
    public function actionCreate()
    {
        $user = new User();
        $user->username = func_num_args() > 0 ? func_get_arg(0) : $this->getStdIn("Enter username: ");
        $user->password = func_num_args() > 1 ? func_get_arg(1) : $this->getStdIn("Enter password: ");
        $user->generateAuthKey();

        if (!$user->save()) {
            $this->showErrors($user);
        } else {
            $this->stdout("* {$user->username} was added\n", Console::FG_GREEN);
        }
    }

    protected function getStdIn($message)
    {
        do {
            $this->stdout($message, Console::FG_YELLOW);
            $data = Console::stdin();
        } while (!$data) ;
        return $data;
    }

    /**
     * @param User $user
     */
    protected function showErrors($user)
    {
        $_errors = [];
        foreach ($user->getErrors() as $line) {
            $_errors = array_merge($_errors, $line);
        }
        $this->stderr("* " . implode("\n* ", $_errors) . "\n", Console::FG_RED);
    }

    /**
     * @param $username
     * @return User
     * @throws Exception
     */
    protected function findUser($username)
    {
        if (($user = User::findOne(['username' => trim($username)])) === null) {
            throw new Exception("User not found");
        } else {
            return $user;
        }
    }
}