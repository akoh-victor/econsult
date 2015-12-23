<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class QuestionsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
	

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('firstName', 'text', array(
                'attr'=>array('class'=>'form-control'),
                'label' => 'First Name',
                'attr' => array('class'=>'form-control'),
                ))

            ->add('lastName', 'text',
                array('label' => 'Last Name',
                    'attr' => array('class'=>'form-control'),))

            ->add('email', 'email', array(
                'label' => 'Email',
                'attr' => array('class'=>'form-control'),
            ))


            ->add('comments', 'textarea', array(

                        'attr' => array(
                             'cols' => 40,
                            'required' => false,
                             'rows' => 3,
                            'class'=>'form-control  has-success has-feedback',
                         ),
                        'label' => 'Comment',

            ))
            ->add('question', 'textarea', array(

                'attr' => array(
                    'cols' => 40,
                    'rows' => 5,
                    'class'=>'form-control  has-success has-feedback'),
                'label' => 'Questions',
                //'read_only' =>'readonly'
            ))



        ->add('save', 'submit', array(
        		'label' => 'Ask Now',
                'attr'=>array('class'=>'btn btn-ml btn-info ')
     
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Questions',
        ));


    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_question';
    }
}
