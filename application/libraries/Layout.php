<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 *
 * Layout Library
 *
 * @package     Application
 * @subpackage  Libraries
 * @category    View
 * @author      Glenn Michael V. Tan <gmichael_05@hotmail.com>
 * @version     $Revision$
 */
class Layout {
    /**
     * The layout view directory
     * @var string
     */
    const LAYOUT_DIR = 'templates';
    /**
     * Holds CI Object
     * @var Codeigniter
     */
    protected $_ci;
    /**
     * Name of the layout
     * @var string
     */
    protected $_layout;

    /**
     * Layout class constructor
     * @param string $layout The layout name to use.
     */
    public function __construct($layout = 'main')
    {
        $this->_ci =& get_instance();
        $this->_layout = $layout;
    }

    /**
     * Sets the layout to use.
     * @param string $layout The layout name to use;
     * @return Returns a fluent interface
     */
    public function set_layout($layout)
    {
        $this->_layout = $layout;
        return $this;
    }

    /**
     * Renders the view specified
     * @param string $view  The name of the view file to render
     * @param array $data[optional] The data variables you want to pass in
     *  your view file.
     * @param boolean $return[optional] Wether to return the output as string
     *  or output it directly to the page. Default "false" means output the
     *  view directly to page.
     * @return string Returns the view as a string if $return is true.
     */
    public function view($view, $data=null, $return=false)
    {
        $layout_view = self::LAYOUT_DIR . "/" . $this->_layout;
        $view_data = array();

        $view_data['layout_contents'] = $this->_ci->load->view($view, $data, true);

        if ($return) { // Returns the view as a variable
            return $this->_ci->load->view($layout_view,
                $view_data, true);
        } else { // Outputs the layout to page.
            $this->_ci->load->view($layout_view,
                $view_data, false);
        }
    }
}

/* end of file layout.php */
/* Location: ./application/libraries/layout.php  */