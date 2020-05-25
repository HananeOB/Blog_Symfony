<?php
namespace App\Command;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
class UserPromoteCommand extends Command
{
    protected static $defaultName = 'app:user:promote';
    private $om;

    public function __construct(EntityManagerInterface $om)
    {
        $this->om = $om;

        parent::__construct();
    }
    protected function configure()
    {
        $this
            ->setDescription('Ajoute un nouveau rôle à un utilisateur')
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l\'utilisateur à promouvoir.')
            ->addArgument('roles', InputArgument::REQUIRED, 'Les rôles que vous voulez ajouter.')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $input->getArgument('email');
        $roles = $input->getArgument('roles');

        $userRepository = $this->om->getRepository(Users::class);
        $user = $userRepository->findOneByEmail($email);

        if ($user) {

            $user->addRoles($roles);
            $this->om->flush();
            $io->success('Le rôle a bien été ajouté .');

        } else {

            $io->error('Pas d\'utilisateur connu avec cet email .');
            
        }
    return 0;
    }
}