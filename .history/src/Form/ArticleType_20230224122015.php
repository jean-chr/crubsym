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
                'choices' => [
                    new Category('Cat1'),
                    new Category('Cat2'),
                    new Category('Cat3'),
                    new Category('Cat4'),
                ],
                // "name" is a property path, meaning Symfony will look for a public
                // property or a public method like "getName()" to define the input
                // string value that will be submitted by the form
                'choice_value' => 'name',
                // a callback to return the label for a given choice
                // if a placeholder is used, its empty value (null) may be passed but
                // its label is defined by its own "placeholder" option
                'choice_label' => function (?Category $category) {
                    return $category ? strtoupper($category->getTitre()) : '';
                },
                // returns the html attributes for each option input (may be radio/checkbox)
                'choice_attr' => function (?Category $category) {
                    return $category ? ['class' => 'category_'.strtolower($category->getTitre())] : [];
                },
                // every option can use a string property path or any callable that get
                // passed each choice as argument, but it may not be needed
                'group_by' => function () {
                    // randomly assign things into 2 groups
                    return rand(0, 1) == 1 ? 'Group A' : 'Group B';
                },
                ,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
