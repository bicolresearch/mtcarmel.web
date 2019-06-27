<?php

/*
    Filename    : Basilica.php
    Location    : application/controller/Basilica.php
    Purpose     : Basilica Controller
    Created     : 6/24/2019 by Sherlock Holmes
    Updated     : 6/27/2019 by Sherlock Holmes
    Changes     : Changed commenting format
*/

defined('BASEPATH') or exit('No direct script access allowed');

class Basilica extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
    }

    public function mass_schedule()
    {
        $view_data = [
            'page_title' => 'Mass Schedule'
        ];

        $this->twig->display('basilica/mass-schedule.html', $view_data);
    }

    public function location_map()
    {
        $view_data = [
            'page_title' => 'Location Map'
        ];

        $this->twig->display('basilica/location-map.html', $view_data);
    }

    public function carmelite_priests()
    {
        $view_data = [
            'page_title' => 'Carmelite Priests'
        ];

        $this->twig->display('basilica/carmelite-priests.html', $view_data);
    }

    public function contact_details()
    {
        $view_data = [
            'page_title' => 'Contact Details'
        ];

        $this->twig->display('basilica/contact-details.html', $view_data);
    }

    public function history()
    {
        $view_data = [
            'page_title' => 'History'
        ];

        $this->twig->display('basilica/history.html', $view_data);
    }

    public function coords()
    {
        if (!$this->input->is_ajax_request()) {
           redirect('auth', 'refresh');
        }

        $response = [
            [
                "lng" => -238.9836136,
                "lat" => 14.6193038
            ],
            [
                "lng" => -238.9836216,
                "lat" => 14.6191845
            ],
            [
                "lng" => -238.9835224,
                "lat" => 14.6189976
            ],
            [
                "lng" => -238.983179,
                "lat" => 14.618764
            ],
            [
                "lng" => -238.9827928,
                "lat" => 14.618777
            ],
            [
                "lng" => -238.9814329,
                "lat" => 14.6190054
            ],
            [
                "lng" => -238.9808938,
                "lat" => 14.6190599
            ],
            [
                "lng" => -238.9805639,
                "lat" => 14.6189405
            ],
            [
                "lng" => -238.9803547,
                "lat" => 14.6187173
            ],
            [
                "lng" => -238.9793435,
                "lat" => 14.6165839
            ],
            [
                "lng" => -238.9791262,
                "lat" => 14.6156002
            ],
            [
                "lng" => -238.9791745,
                "lat" => 14.6152498
            ],
            [
                "lng" => -238.9792415,
                "lat" => 14.6149046
            ],
            [
                "lng" => -238.9793864,
                "lat" => 14.6142195
            ],
            [
                "lng" => -238.9794534,
                "lat" => 14.6138016
            ],
            [
                "lng" => -238.9797083,
                "lat" => 14.6129062
            ],
            [
                "lng" => -238.9799979,
                "lat" => 14.6120237
            ],
            [
                "lng" => -238.9800113,
                "lat" => 14.6115332
            ],
            [
                "lng" => -238.9799657,
                "lat" => 14.6112165
            ],
            [
                "lng" => -238.9798102,
                "lat" => 14.6108194
            ],
            [
                "lng" => -238.9787024,
                "lat" => 14.6095165
            ],
            [
                "lng" => -238.9784154,
                "lat" => 14.6100667
            ],
            [
                "lng" => -238.977415,
                "lat" => 14.6114216
            ],
            [
                "lng" => -238.9769778,
                "lat" => 14.6121561
            ],
            [
                "lng" => -238.9768866,
                "lat" => 14.6128517
            ],
            [
                "lng" => -238.9767739,
                "lat" => 14.613542
            ],
            [
                "lng" => -238.9766586,
                "lat" => 14.6137627
            ],
            [
                "lng" => -238.9763984,
                "lat" => 14.6138795
            ],
            [
                "lng" => -238.976216,
                "lat" => 14.6139158
            ],
            [
                "lng" => -238.9756635,
                "lat" => 14.613773
            ],
            [
                "lng" => -238.9750305,
                "lat" => 14.6135161
            ],
            [
                "lng" => -238.9748776,
                "lat" => 14.6131112
            ],
            [
                "lng" => -238.9747408,
                "lat" => 14.6127089
            ],
            [
                "lng" => -238.9746282,
                "lat" => 14.612548
            ],
            [
                "lng" => -238.9744189,
                "lat" => 14.6124078
            ],
            [
                "lng" => -238.9740166,
                "lat" => 14.6123559
            ],
            [
                "lng" => -238.9727747,
                "lat" => 14.6123793
            ],
            [
                "lng" => -238.9719164,
                "lat" => 14.6123326
            ],
            [
                "lng" => -238.9713505,
                "lat" => 14.6120808
            ],
            [
                "lng" => -238.9710715,
                "lat" => 14.6121742
            ],
            [
                "lng" => -238.9708355,
                "lat" => 14.6124442
            ],
            [
                "lng" => -238.9708328,
                "lat" => 14.6128828
            ],
            [
                "lng" => -238.9705324,
                "lat" => 14.6131138
            ],
            [
                "lng" => -238.970165,
                "lat" => 14.6132098
            ],
            [
                "lng" => -238.9699021,
                "lat" => 14.6131813
            ],
            [
                "lng" => -238.9695722,
                "lat" => 14.6130333
            ],
            [
                "lng" => -238.969084,
                "lat" => 14.6129581
            ],
            [
                "lng" => -238.9687434,
                "lat" => 14.6123663
            ],
            [
                "lng" => -238.9685449,
                "lat" => 14.6121535
            ],
            [
                "lng" => -238.9684162,
                "lat" => 14.6119614
            ],
            [
                "lng" => -238.9681908,
                "lat" => 14.6116915
            ],
            [
                "lng" => -238.967818,
                "lat" => 14.6114735
            ],
            [
                "lng" => -238.9671099,
                "lat" => 14.6108012
            ],
            [
                "lng" => -238.9665306,
                "lat" => 14.6100096
            ],
            [
                "lng" => -238.9662489,
                "lat" => 14.6097034
            ],
            [
                "lng" => -238.9660478,
                "lat" => 14.6095918
            ],
            [
                "lng" => -238.9655864,
                "lat" => 14.6095035
            ],
            [
                "lng" => -238.9651439,
                "lat" => 14.6094698
            ],
            [
                "lng" => -238.9649105,
                "lat" => 14.6092128
            ],
            [
                "lng" => -238.9646879,
                "lat" => 14.6089091
            ],
            [
                "lng" => -238.964484,
                "lat" => 14.6087586
            ],
            [
                "lng" => -238.9643365,
                "lat" => 14.608756
            ],
            [
                "lng" => -238.9641809,
                "lat" => 14.6089662
            ],
            [
                "lng" => -238.9635855,
                "lat" => 14.6090856
            ],
            [
                "lng" => -238.9633682,
                "lat" => 14.6091998
            ],
            [
                "lng" => -238.9632207,
                "lat" => 14.6093192
            ],
            [
                "lng" => -238.9630812,
                "lat" => 14.6094205
            ],
            [
                "lng" => -238.9629257,
                "lat" => 14.6094568
            ],
            [
                "lng" => -238.962644,
                "lat" => 14.6094853
            ],
            [
                "lng" => -238.9623356,
                "lat" => 14.6093945
            ],
            [
                "lng" => -238.9621344,
                "lat" => 14.6094153
            ],
            [
                "lng" => -238.9616328,
                "lat" => 14.60968
            ],
            [
                "lng" => -238.9614344,
                "lat" => 14.6097163
            ],
            [
                "lng" => -238.9612037,
                "lat" => 14.6096177
            ],
            [
                "lng" => -238.961083,
                "lat" => 14.6096203
            ],
            [
                "lng" => -238.960973,
                "lat" => 14.6096982
            ],
            [
                "lng" => -238.9607772,
                "lat" => 14.6100537
            ],
            [
                "lng" => -238.9606082,
                "lat" => 14.610238
            ],
            [
                "lng" => -238.9603186,
                "lat" => 14.6102744
            ],
            [
                "lng" => -238.9598733,
                "lat" => 14.6102173
            ],
            [
                "lng" => -238.959699,
                "lat" => 14.6102406
            ],
            [
                "lng" => -238.9592618,
                "lat" => 14.6100901
            ],
            [
                "lng" => -238.9590338,
                "lat" => 14.6100979
            ],
            [
                "lng" => -238.9586636,
                "lat" => 14.6103834
            ],
            [
                "lng" => -238.9583042,
                "lat" => 14.6106403
            ],
            [
                "lng" => -238.9582103,
                "lat" => 14.6106611
            ],
            [
                "lng" => -238.9583632,
                "lat" => 14.6107441
            ],
            [
                "lng" => -238.9585134,
                "lat" => 14.6111854
            ],
            [
                "lng" => -238.958602,
                "lat" => 14.6113697
            ],
            [
                "lng" => -238.9586878,
                "lat" => 14.6114242
            ],
            [
                "lng" => -238.9588058,
                "lat" => 14.6114761
            ],
            [
                "lng" => -238.959251,
                "lat" => 14.6116032
            ],
            [
                "lng" => -238.9606458,
                "lat" => 14.6123118
            ],
            [
                "lng" => -238.961032,
                "lat" => 14.6126726
            ],
            [
                "lng" => -238.961142,
                "lat" => 14.6127245
            ],
            [
                "lng" => -238.9612681,
                "lat" => 14.6127452
            ],
            [
                "lng" => -238.9615738,
                "lat" => 14.6127894
            ],
            [
                "lng" => -238.9609542,
                "lat" => 14.6132903
            ],
            [
                "lng" => -238.960619,
                "lat" => 14.613664
            ],
            [
                "lng" => -238.9604688,
                "lat" => 14.6139314
            ],
            [
                "lng" => -238.9602864,
                "lat" => 14.6143985
            ],
            [
                "lng" => -238.960053,
                "lat" => 14.6146503
            ],
            [
                "lng" => -238.9593905,
                "lat" => 14.6152031
            ],
            [
                "lng" => -238.9648783,
                "lat" => 14.6242506
            ],
            [
                "lng" => -238.9685154,
                "lat" => 14.6239703
            ],
            [
                "lng" => -238.9836136,
                "lat" => 14.6193038
            ]
        ];

        echo json_encode($response);
    }
}