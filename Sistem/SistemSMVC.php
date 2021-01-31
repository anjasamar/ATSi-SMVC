<?php
/**
 * ATSi-SMVC Framework
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2021, ATSi-Development
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	ATSi-SMVC (Simple Model View Control)
 * @author	Anjas Amar Pradana - ATSi(Anjas Tech Software Interface)
 * @copyright	Copyright (c) 2021, ATSi-Development. (https://www.facebook.com/anjelo.sonliberto/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */

    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

    if ($url == '/')
    {

        // This is the home page
        // Initiate the home controller
        // and render the home view

        require_once __DIR__.'/../Aplikasi/Model/M_Index.php';
        require_once __DIR__.'/../Aplikasi/Kontrol/K_Index.php';
        require_once __DIR__.'/../Aplikasi/Tampilan/T_Index.php';


        $indexModel     = New M_Index();
        $indexKontrol   = New K_Index($indexModel);
        $indexTampilan  = New T_Index($indexKontrol, $indexModel);


        print $indexTampilan->index();

    }else{

        // This is not home page
        // Initiate the appropriate controller
        // and render the required view

        //The first element should be a controller
        $requestedKontrol = $url[0]; 

        // If a second part is added in the URI, 
        // it should be a method
        $requestedAction = isset($url[1])? $url[1] :'';

        // The remain parts are considered as 
        // arguments of the method
        $requestedParams = array_slice($url, 2); 

        // Check if controller exists. NB: 
        // You have to do that for the model and the view too
        $ctrlPath = __DIR__.'/../Aplikasi/Kontrol/'.$requestedKontrol.'K_.php';

        if (file_exists($ctrlPath))
        {

            require_once __DIR__.'/../Aplikasi/Models/'.$requestedKontrol.'M_.php';
            require_once __DIR__.'/../Aplikasi/Kontrol/'.$requestedKontrol.'K_.php';
            require_once __DIR__.'/../Aplikasi/Tampilan/'.$requestedKontrol.'T_.php';
            require_once __DIR__.'/../Aset/'.$requestedKontrol.'A_.php';
            require_once __DIR__.'/../Aset/Css/'.$requestedKontrol.'G_.css';

            $namaModel      = ucfirst($requestedKontrol).'Model';
            $namaKontrol    = ucfirst($requestedKontrol).'Kontrol';
            $namaTampilan   = ucfirst($requestedKontrol).'Tampilan';
            $namaAset       = ucfirst($requestedKontrol).'Aset';

            $kontrolObj  = new $namaKontrol( new $namaModel );
            $tampilanObj = new $namaTampilan( $kontrolObj, new $namaModel );

            // If there is a method - Second parameter
            if ($requestedAction != '')
            {
                // then we call the method via the view
                // dynamic call of the view
                print $tampilanObj->$requestedAction($requestedParams);

            }

        }else{

            header('HTTP/1.1 404 Not Found');
            die('404 - The file - '.$ctrlPath.' - not found');
            //require the 404 controller and initiate it
            //Display its view
        }
    }