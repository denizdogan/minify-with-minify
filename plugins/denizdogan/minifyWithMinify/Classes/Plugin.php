<?php
/**
 * Plugin which uses Minify to minify the page output
 */

namespace Phile\Plugin\Denizdogan\MinifyWithMinify;

// manually require the needed libraries because i'm a noob
require('..\\minify-2.3.0\\Minify\\HTML.php');
require('..\\minify-2.3.0\\Minify\\CSS.php');
require('..\\minify-2.3.0\\Minify\\CommentPreserver.php');
require('..\\minify-2.3.0\\Minify\\CSS\\Compressor.php');
require('..\\minify-2.3.0\\Minify\\CSS\\UriRewriter.php');
require('..\\minify-2.3.0\\JSMin.php');

/**
 * The plugin
 *
 * @author  Deniz Dogan <deniz@dogan.se>
 * @license http://opensource.org/licenses/MIT
 */
class Plugin extends \Phile\Plugin\AbstractPlugin
{

    protected $events = [
        'after_render_template' => 'minify'
    ];

    public function __construct()
    {
        $this->minifierOptions = array(
            'cssMinifier' => array('Minify_CSS', 'minify'),
            'jsMinifier' => array('JSMin', 'minify'),
            'xhtml' => false
        );
    }

    /**
     * Minify the output
     *
     * @param array $data The data including the 'output key'
     *
     * @return void
     */
    public function minify($data)
    {
        $data['output'] = \Minify_HTML::minify(
            $data['output'],
            $this->minifierOptions
        );
    }
}
