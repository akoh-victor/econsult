<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class AnswerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
	

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('firstName', 'text', array('label' => 'First Name',
                'attr' => array('class'=>'form-control'),'read_only' =>'read_only'))
            ->add('lastName', 'text', array('label' => 'Last Name', 'attr' => array('class'=>'form-control'),'read_only' =>'read_only'))
            ->add('email', 'email', array('label' => 'Email', 'attr' => array('class'=>'form-control'),'read_only' =>'read_only'))
            ->add('relivance','choice',array(
                'label' => 'Relivance ',
                'choices' => array('1' => 'Relivant', '0' => 'Irelivant','required' => false),
                'attr' => array('class'=>'form-control'),
            ))
            ->add('visibility','choice',array(
                'label' => 'Display on Faq ',
                'choices' => array('0' => 'No', '1' => 'Yes','required' => false),
                'attr' => array('class'=>'form-control'),
            ))

            ->add('comments', 'textarea', array(

                        'attr' => array('cols' => 70,
                             'rows' => 1,'class'=>'form-control'),
                        'label' => 'Comment',
                        'read_only' =>'read_only'
            ))
            ->add('question', 'textarea', array(

                'attr' => array('cols' => 70,
                    'rows' => 2,'class'=>'form-control'),
                'label' => 'Questions',
                'read_only' =>'read_only'
            ))

            ->add('answer', 'textarea', array(

                 'attr' => array('cols' => 70,
                    'rows' => 2,'class'=>'form-control'),
                'label' => 'Answer',
            ))

        ->add('save', 'submit', array(
        		'label' => 'Answer',
        'attr'=>array('class'=>'btn btn-md btn-info')
     
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
        return 'app_answer';
    }
}
