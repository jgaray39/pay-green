//deploiement local

composer install,
bin/console doctrine:migrations:migrate,
bin/console doctrine:fixtures:load,
bin/console lexik:jwt:generate-keypair

//deux comptes => le compte admin et le compte user
//seul le compte admin peut voir la liste des utilisateurs

