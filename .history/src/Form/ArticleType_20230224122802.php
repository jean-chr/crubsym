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
                'choices' => function (?Category $category) {
                    return $category ? strtoupper($category->getTitre()) : 'valeur ';
                },

                'choice_value' => 'id',

                'choice_label' => function (?Category $category) {
                    return $category ? strtoupper($category->getTitre()) : 'valeur ';
                },

                'choice_attr' => function (?Category $category) {
                    return $category ? ['class' => 'category_'.strtolower($category->getTitre())] : [];
                },
                
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
