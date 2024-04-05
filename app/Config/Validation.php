<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

use App\Validation\CustomRule;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRule::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $login = [
        'emailLogin' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email cannot be null.',
                'valid_email' => 'Please insert valid email.'
            ]
        ],
        'passwordLogin' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Password cannot be null.'
            ]
        ],
    ];

    public $payment = [
        'payment' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Please input your payment.',
                'numeric' => 'Payment is not valid.'
            ]
        ]
    ];

    public $addbook = [
        'title' => [
            'rules' => 'required|string',
            'errors' => [
                'required' => 'Name cannot be null.'
            ]
        ],
        'category' => [
            'rules' => 'required|categoryValidation',
            'errors' => [
                'required' => 'Category cannot be null.',
                'categoryValidation' => 'Category is not valid.'
            ]
        ],
        'year' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Year cannot be null.',
                'numeric' => 'Year must be numeric.'
            ]
        ],
        'amount' => [
            'rules' => 'required|numeric|greater_than[0]',
            'errors' => [
                'required' => 'Amount cannot be null.',
                'numeric' => 'Amount must be numeric.',
                'greater_than' => 'Amount must be greater than 0.'
            ]
        ],
        'status' => [
            'rules' => 'required|statusValidation',
            'errors' => [
                'required' => 'Status cannot be null.',
                'statusValidation' => 'Status is not valid.'
            ]
        ],
        'synopsis' => [
            'rules' => 'string'
        ],
        'publisher_id' => [
            'rules' => 'publisherIDValidation',
            'errors' => [
                'publisherIDValidation' => 'Publisher ID not found.'
            ]
        ],
        'author_id' => [
            'rules' => 'authorIDValidation',
            'errors' => [
                'authorIDValidation' => 'There is one or more unavailable Author ID.'
            ]
        ],
        'genre_id' => [
            'rules' => 'required|genreIDValidation',
            'errors' => [
                'required' => 'Genre cannot be null.',
                'genreIDValidation' => 'There is one or more unavailable Genre ID.'
            ]
        ],
        'imageBook' => [
            'rules' => 'is_image[imageBook]',
            'errors' => [
                'is_image' => "Please upload valid image."
            ]
        ]
    ];

    public $addauthor = [
        'name' => [
            'rules' => 'required|alpha_space',
            'errors' => [
                'required' => 'Name cannot be null.',
                'alpha_space' => 'Name can only be alphabet and space.'
            ]
        ],
        'birthdate' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Birth date cannot be null.',
                'valid_date' => 'Birth date is not valid.'
            ]
        ],
        'imageAuthor' => [
            'rules' => 'is_image[imageAuthor]',
            'errors' => [
                'is_image' => "Please upload valid image."
            ]
        ]
    ];

    public $addgenre = [
        'name' => [
            'rules' => 'required|alpha_space',
            'errors' => [
                'required' => 'Name cannot be null.',
                'alpha_space' => 'Name can only be alphabet and space.'
            ]
        ]
    ];

    public $addpublisher = [
        'name' => [
            'rules' => 'required|string',
            'errors' => [
                'required' => 'Name cannot be null.'
            ]
        ],
        'address' => [
            'rules' => 'required|string',
            'errors' => [
                'required' => 'Address cannot be null.',
            ],
        ],
        'imagePublisher' => [
            'rules' => 'is_image[imagePublisher]',
            'errors' => [
                'is_image' => "Please upload valid image."
            ]
        ]
    ];

    public $register = [
        'name' => [
            'rules' => 'required|alpha_space',
            'errors' => [
                'required' => 'Name cannot be null.',
                'alpha_space' => 'Name can only be alphabet and space.'
            ]
        ],
        'gender' => [
            'rules' => 'required|genderValidation',
            'errors' => [
                'required' => 'Gender cannot be null.',
                'genderValidation' => 'Gender is not valid.'
            ]
        ],
        'birthdate' => [
            'rules' => 'required|valid_date',
            'errors' => [
                'required' => 'Birth date cannot be null.',
                'valid_date' => 'Birth date is not valid.'
            ]
        ],
        'phone' => [
            'rules' => 'required|numeric|max_length[12]|min_length[12]',
            'errors' => [
                'required' => 'Phone cannot be null.',
                'numeric' => 'Phone is not valid.',
                'max_length' => 'Phone must be 12 number.',
                'min_length' => 'Phone must be 12 number.',
            ]
        ],
        'address' => [
            'rules' => 'required|string',
            'errors' => [
                'required' => 'Address cannot be null.',
            ],
        ],
        'emailReg' => [
            'rules' => 'required|valid_email',
            'errors' => [
                'required' => 'Email cannot be null.',
                'valid_email' => 'Email is not valid.'
            ]
        ],
        'passwordReg' => [
            'rules' => 'required|min_length[8]',
            'errors' => [
                'required' => 'Password cannot be null.',
                'min_length' => 'Password length must be at least 8 character.'
            ]
        ],
        'confPassword' => [
            'rules' => 'required|matches[passwordReg]',
            'errors' => [
                'required' => 'Please re-input the password.',
                'matches' => 'Password confirmation must match with password.'
            ]
        ]
    ];
}
