<?php

namespace Drupal\mymodule\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

use Drupal\mymodule\libs\MyModuleDao;

/**
 * Controller routines for page example routes.
 */
class DefaultController extends ControllerBase {

	private $connectDao;

	public function __construct(MyModuleDao $connectDao)
  {
      $this->connectDao = $connectDao;
  }

  public static function create(ContainerInterface $container)
  {
      $connectDao = $container->get('mymodule.mymodule_dao');
      return new static($connectDao);
  }

	public function defaultAction() {

		$result = $this->connectDao->status;
		$user = $this->connectDao->getUser();

		$build = array(
      '#markup' => '<h2> My Module. Default Action -> <strong>'.$result.'</strong> </h2><p>'.$user.'</p>',
    );

    return $build;
	}


	public function templateAction() {
		return [
            '#theme' => 'default-page'
        ];
	}

	public function anotherTemplateAction() {

		$result = $this->connectDao->status;
		$user = $this->connectDao->getUser();

		$another_template = array(
		  '#theme' => 'another-template',
		  '#param_1' => 'asdsadaaaaaaaa',
  		'#param_2' => 'asdasdd',
  		'#user_name' => $user['name'],
  		'#user_lastname' => $user['lastname'],
		);

		$output = drupal_render($another_template,
		  array(
		    'variables' => array(
		      'param_1' => $param_1,
		      'param_2' => $param_2,
		      //'param_2' => $user_name,
		    )
		  )
		);

		//kint($output);

		return [
		    '#type' => 'markup',
		    '#markup' => $output
		];

		// return [
  //           '#theme' => 'default-page'
  //       ];
	}
}