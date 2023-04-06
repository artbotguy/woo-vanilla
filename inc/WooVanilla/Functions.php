<?php

namespace Awps\WooVanilla;

class Functions
{
  public function __construct()
  {
  }

  public function woovanilla_do_shortcode($tag, array $atts = array(), $content = null)
  {
    global $shortcode_tags;

    if (!isset($shortcode_tags[$tag])) {
      return false;
    }

    return call_user_func($shortcode_tags[$tag], $atts, $content, $tag);
  }
}
