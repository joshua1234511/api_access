<?php

namespace Drupal\api_access\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\NodeInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiAccessController.
 */
class ApiAccessController extends ControllerBase {

  /**
   * Validate and return json data.
   *
   * @param string $api_key
   *   API Key.
   * @param \Drupal\node\NodeInterface $node
   *   Node object.
   *
   * @return \Symfony\Component\HttpFoundation\JsonResponse
   *   Return the json output.
   */
  public function outputData($api_key, NodeInterface $node) {
    $valid_api_key = $this->config('system.site')->get('siteapikey');
    if ($node->getType() === 'page' && $valid_api_key === $api_key) {
      return new JsonResponse([$node->toArray(), 200]);
    }
    else {
      return new JsonResponse(['Access Denied', 401]);
    }
  }

}
