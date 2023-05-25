<?php

namespace App\Controller\Admin;

use App\Entity\Loan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class LoanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Loan::class;
    }

    public function configureFields(string $pageName): iterable
    {

        $dateEndField = DateTimeField::new('date_end', 'Date de fin')
            ->formatValue(function ($value, $entity) {
                $today = new \DateTime();
                $dateEnd = new \DateTime($value);


                if ($entity->isLoanBack()) {
                    return $dateEnd->format('d-m-Y');
                }

                if ($dateEnd <= $today) {
                    return '<span style="color: red; font-weight: bold">'.$dateEnd->format('d-m-Y').'</span>';
                }

                return $dateEnd->format('d-m-Y');
            });


        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user', 'Utilisateur'),
            AssociationField::new('id_book', 'Livre'),
            DateTimeField::new('date_start', 'Date de début')->formatValue(function ($value) {
                return (new \DateTime($value))->format('d-m-Y');
            }),
            $dateEndField,
            BooleanField::new('loan_back', 'Rendu')
        ];
    }

}
