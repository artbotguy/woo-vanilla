<?php

namespace Awps\WooCommerce;

use Awps\Woocommerce\TemplateFunctions;

class TemplateHooks
{
  private $template_functions;

  public function __construct()
  {
    $this->template_functions = new TemplateFunctions;

    $this->homepage();
  }

  public function homepage()
  {
    add_action('homepage', [$this->template_functions, 'woovanilla_recent_products'], 0);
    // add_action('homepage', [$this->template_functions, 'woovanilla_promoted_products'], 0);
  }
}
