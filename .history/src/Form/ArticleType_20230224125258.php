<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('prix')
            ->add('contenu')
            ->add('image')
            ->add('description')
            ->add('category', ChoiceType::class,
            [
                'label_attr' => [
                    'class' => "font-weight-bold"
                ],
                'label' => "La caterorie",
                'required' => false,                
                'choice_label' => function(?Category $choice) {                    
                    return $choice ? $choice->getTitre() : null;
                },
                'choice_value' => static function(?Category $choice): int {  
                    return $choice->getId() ?? 0;    
                } 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
