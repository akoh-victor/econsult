<?php

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Akoh Ojochuma Victor <akoh.chuma@gmail.com>
 */




class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
	

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //     $builder->add('content', null, array('required' => false));

        $builder
            ->add('title', null, array('label' => 'Title', 'attr' => array('class'=>'form-control'),))


            ->add('file', 'file', array(
                'data_class' => null,
                'required' => false,
                'label' => 'Image',
            ))



            ->add('article', 'textarea', array(

                    'attr' => array('cols' => 80,
                                     'rows' => 10),
                    'label' => 'Article',
            ))

            ->add('save', 'submit', array(
                    'label' => 'Save',
            'attr'=>array('class'=>'btn btn-md btn-info')

            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News',
        ));


    }

    /**
     * @return string
     */
    public function getName()
    {
        // Best Practice: use 'app_' as the prefix of your custom form types names
        // see http://symfony.com/doc/current/best_practices/forms.html#custom-form-field-types
        return 'app_news';
    }
}
