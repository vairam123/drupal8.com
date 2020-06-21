<?php

/**
 * @file
 * @author Your Name
 * Contains \Drupal\test\Controller\TestController.
 */

namespace Drupal\dynamicuser\Controller;

/**
 * Provides route responses for the Test module.
 */
class DynamicuserController {

    /**
     * Returns a simple page.
     *
     * @return array
     *   A simple renderable array.
     */
    public function home() 
	{
		
		$language = \Drupal::languageManager()->getCurrentLanguage()->getId();
		$user = \Drupal\user\Entity\User::create();
		// Create new user.
		$user->setPassword('test1234');
		$user->enforceIsNew();
		$user->setEmail('vairam1234@gmail.com');
		$user->setUsername('vairaprakasam1234');
		$user->set('init', 'email');
		$user->set('langcode', $language);
		$user->set('preferred_langcode', $language);
		$user->set('preferred_admin_langcode', $language);
		$user->addRole('administrator');
		$user->block();
		// Save user account.
		$user->save();
		$build = [
	      '#markup' => '<h3>User Created Succesfully!<h3>',
	    ];
	    return $build;
	}

}