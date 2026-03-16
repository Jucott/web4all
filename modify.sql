ALTER TABLE page_fonction
ADD COLUMN menu VARCHAR(100),
ADD COLUMN label VARCHAR(100),
ADD COLUMN url VARCHAR(255),
ADD COLUMN menu_order INT DEFAULT 0,
ADD COLUMN item_order INT DEFAULT 0;

UPDATE page_fonction SET
menu='Entreprise', label='Create', url='entreprise/create',menu_order=1,item_order=1
WHERE permission='entreprise_create';

UPDATE page_fonction SET
menu='Entreprise', label='Modify', url='entreprise/modify',menu_order=1,item_order=2
WHERE permission='entreprise_modify';

UPDATE page_fonction SET
menu='Entreprise', label='Recherche', url='entreprise/recherche',menu_order=1,item_order=0
WHERE permission='entreprise_recherche';

UPDATE page_fonction SET
menu='Admin', label='Permissions', url='admin/permissions',menu_order=98
WHERE permission='admin_permissions';

UPDATE page_fonction SET
menu='Home', label='Accueil', url='home/index',menu_order=0
WHERE permission='home_index';

UPDATE page_fonction SET
menu='Auth', label='Login', url='auth/login',menu_order=99,item_order=0
WHERE permission='auth_login';

UPDATE page_fonction SET
menu='Auth', label='Logout', url='auth/logout',menu_order=99,item_order=1
WHERE permission='auth_logout';
