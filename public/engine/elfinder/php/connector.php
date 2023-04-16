<?php
    /* Set E_ALL for debugging purpose */
    error_reporting(0);
    /*
     * Define aidiCMS connector for elfinder
     * all classmap will be included automatically from composer
     * line below is REQUIRED for admin section (integrated with tinymce)
     */
    define('CONNECTOR', 'elfinder');
    include '../../../index.php';
    define('ELFINDER_IMG_PARENT_URL', $core->domain . $core->path . '/engine/elfinder/');
    define('CONNECTOR_PATH', realpath(dirname(APP_PATH . '/vendor/elfinder/php/elFinder.class.php')));
    //--- END AIDICMS ADMIN SECTION ---//

    /*
     * Dropbox volume driver need "dropbox-php's Dropbox" and "PHP OAuth extension" or "PEAR's HTTP_OAUTH package"
     * dropbox-php: http://www.dropbox-php.com/
     * PHP OAuth extension: http://pecl.php.net/package/oauth
     * PEAR's HTTP_OAUTH package: http://pear.php.net/package/http_oauth
     * HTTP_OAUTH package require HTTP_Request2 and Net_URL2
     */
    // Dropbox driver need next two settings. You can get at https://www.dropbox.com/developers
    // define('ELFINDER_DROPBOX_CONSUMERKEY',    '');
    // define('ELFINDER_DROPBOX_CONSUMERSECRET', '');
    // define('ELFINDER_DROPBOX_META_CACHE_PATH',''); // optional for `options['metaCachePath']`

/*
 * Simple function to demonstrate how to control file access using "accessControl" callback.
 * This method will disable accessing files/folders starting from '.' (dot)
 *
 * @param  string  $attr  attribute name (read|write|locked|hidden)
 * @param  string  $path  file path relative to volume root directory started with directory separator
 * @return bool|null
 */
    function access($attr, $path, $data, $volume) {
        return strpos(basename($path), '.') === 0       // if file/folder begins with '.' (dot)
            ? !($attr == 'read' || $attr == 'write')    // set read+write to false, other (locked+hidden) set to true
            :  null;                                    // else elFinder decide it itself
    }

    // Documentation for connector options:
    // https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
    $opts = array(
        // 'debug' => true,
        // plugin AutoResize
        /*
        'bind' => array(
 *			'upload.presave' => array(
 *				'Plugin.AutoResize.onUpLoadPreSave'
 *			)
 *		),
 *		// global configure (optional)
 *		'plugin' => array(
 *			'PluginAutoResize' => array(
 *				'enable'         => true,       // For control by volume driver
 *				'maxWidth'       => 1024,       // Path to Water mark image
 *				'maxHeight'      => 1024,       // Margin right pixel
 *				'quality'        => 95,         // JPEG image save quality
 *				'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP // Target image formats ( bit-field )
 *			)
 *		),
         *
         */

        // plugin Normalizer
        /*
        'bind' => array(
 *			'mkdir.pre mkfile.pre rename.pre' => array(
 *				'Plugin.Normalizer.cmdPreprocess'
 *			),
 *			'upload.presave' => array(
 *				'Plugin.Normalizer.onUpLoadPreSave'
 *			)
 *		),
 *		// global configure (optional)
 *		'plugin' => array(
 *			'Normalizer' => array(
 *				'enable' => true,
 *				'nfc'    => true,
 *				'nfkc'   => true
 *			)
 *		),
         *
         */

        // plugin Sanitizer
        /*
        'bind' => array(
 *			'mkdir.pre mkfile.pre rename.pre' => array(
 *				'Plugin.Sanitizer.cmdPreprocess'
 *			),
 *			'upload.presave' => array(
 *				'Plugin.Sanitizer.onUpLoadPreSave'
 *			)
 *		),
 *		// global configure (optional)
 *		'plugin' => array(
 *			'Sanitizer' => array(
 *				'enable' => true,
 *				'targets'  => array('\\','/',':','*','?','"','<','>','|'), // target chars
 *				'replace'  => '_'    // replace to this
 *			)
 *		),
         *
         */

        // plugin Watermark
        /*
        'bind' => array(
 *			'upload.presave' => array(
 *				'Plugin.Watermark.onUpLoadPreSave'
 *			)
 *		),
 *		// global configure (optional)
 *		'plugin' => array(
 *			'Watermark' => array(
 *				'enable'         => true,       // For control by volume driver
 *				'source'         => 'logo.png', // Path to Water mark image
 *				'marginRight'    => 5,          // Margin right pixel
 *				'marginBottom'   => 5,          // Margin bottom pixel
 *				'quality'        => 95,         // JPEG image save quality
 *				'transparency'   => 70,         // Water mark image transparency ( other than PNG )
 *				'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
 *				'targetMinPixel' => 200         // Target image minimum pixel size
 *			)
 *		),
         *
         */

        'roots' => array(
            array(
                'driver'        => 'LocalFileSystem',   // driver for accessing file system (REQUIRED)
                'path'          => '../../../data/',         // path to files (REQUIRED)
                'URL'           => _PATH . 'data/', // URL to files (REQUIRED)
                'alias'         => 'Data',
                'accessControl' => 'access'             // disable and hide dot starting files (OPTIONAL)
            ),
            array(
                'driver'        => 'LocalFileSystem',
                'path'          => '../../../images/',
                'URL'           => _PATH . 'images/',
                'alias'         => 'Images',
                'accessControl' => 'access'
            )
        )
    );

    // run elFinder
    $connector = new elFinderConnector(new elFinder($opts));
    $connector->run();

