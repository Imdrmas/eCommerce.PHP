<?php
if (!(isset($_SESSION))) session_start();

//Vérifier si une langue été mise en
if (isset($_GET['lang'])){
		$_GET['lang'] = $_GET['lang'];
	}elseif (isset($_SESSION['user_language_choice'])){
		$_GET['lang'] = $_SESSION['user_language_choice'];
	}else{
		$_GET['lang'] = $locale->default_language;
}

//Sélection de la langue
$language_choice = isset($_GET['lang']) ? $_GET['lang'] : '';
    switch ($language_choice) {
        case "en":
            $lang = 'en';
            break;
        case "fr":
            $lang = 'fr';
            break;
        case "ar":
            $lang = 'ar';
            break;
        default:
            $lang = $locale->default_language;
            break;
    }
	if (isset($_GET['lang'])){
	$_SESSION['user_language_choice'] = $_GET['lang'];
}

//La langue des tableaux navbar
$Elgadah = array(
	'en' => 'Elgadah',
	'fr' => 'Elgadah',
	'ar' => 'القدح',
	);
$Categories = array(
	'en' => 'Categories',
	'fr' => 'Catégories',
	'ar' => 'التصنيفات',
);
$Items = array(
	'en' => 'Items',
	'fr' => 'Articles',
	'ar' => 'العناصر',
);
$Members = array(
  'en' => 'Members',
  'fr' => 'Members',
  'ar' => 'الأعضاء',
);
$Comments = array(
  'en' => 'Comments',
  'fr' => 'Commentaires',
  'ar' => 'التعليقات',
);
$Admin = array(
  'en' => 'Admin',
  'fr' => 'Admin',
  'ar' => 'الادارة',
);
$Visit_Shop= array(
  'en' => 'Visit Shop',
  'fr' => 'Visiter la boutique',
  'ar' => 'زيارة المتجر',
);
$GropAdmin = array(
	'en' => 'GroupAdmin',
	'fr' => 'GroupAdmin',
	'ar' => 'القدح',
	);
$Edit_Profile = array(
  'en' => 'Edit Profile',
  'fr' => 'Editer le profil',
  'ar' => 'تعديل الملف الشخصي ',
);
$Logout = array(
  'en' => 'Logout',
  'fr' => 'Déconnecter',
  'ar' => 'الخروج ',
);
$Dashboard = array( // dashboard Page
  'en' => 'Dashboard',
  'fr' => 'Tableau de bord',
  'ar' => 'لوحة التحكم الرئيسية ',
);
$Total_Members= array(
  'en' => 'Total Members',
  'fr' => 'Total Members',
  'ar' => 'مجموع الأعضاء ',
);
$Pending_Members = array(
  'en' => 'Pending Members',
  'fr' => 'Membres en attente',
  'ar' => 'في انتظار المراجعة ',
);
$Total_Items = array(
  'en' => 'Total Items',
  'fr' => 'Articles au total',
  'ar' => 'إجمالي العناصر ',
);
$Total_Comments = array(
  'en' => 'Total Comments',
  'fr' => 'Nombre total de commentaires',
  'ar' => 'إجمالي التعليقات ',
);
$Latest_Registered_Users = array(
  'en' => 'Latest 5 Registered Users',
  'fr' => 'Derniers 5 utilisateurs enregistrés',
  'ar' => 'آخر 5 أعضاء مسجلين ',
);
$Latest_Items= array(
  'en' => 'Latest 5 Items',
  'fr' => 'Derniers 5 articles',
  'ar' => 'آخر 5 عنصر',
);
$Latest_Comments = array(
  'en' => 'Latest 5 Comments',
  'fr' => 'Derniers 5 commentaires',
  'ar' => 'آخر 5 تعليقات',
);
$Theres_no_memeber_to_show = array(
  'en' => 'There\'s no memebers to show',
  'fr' => 'Il n\'y a pas de membres à montrer',
  'ar' => 'ليس هناك أعضاء لتظهر ',
);
$Theres_No_Item_To_Show= array (
  'en' => 'There\'s No Item To Show',
  'fr' => 'Il n\'y a aucun élément à afficher',
  'ar' => 'لا يوجد عنصر لإظهار ',
);
$Theres_No_Category_To_Show = array(
  'en' => 'There\'s No Category To Show',
  'fr' => 'Il n\'y a aucune catégorie à afficher',
  'ar' => 'لا توجد تصنيفات  للعرض',
);
$Theres_No_Comments_To_Show = array(
  'en' => 'There\'s No Comments To Show',
  'fr' => 'Il n\'y a aucun commentaire à afficher',
  'ar' => 'ليس هناك تعليقات للعرض',
);
$Manage_Categories = array( //Categories Page
  'en' => 'Manage Categories',
  'fr' => 'Gérer les catégories',
  'ar' => 'إدارة التصنيفات',
);
$Asc = array(
  'en' => 'Asc',
  'fr' => 'Asc',
  'ar' => 'تصاعدي',
);
$DESC = array(
  'en' => 'Desc',
  'fr' => 'Desc',
  'ar' => 'تنازلي',
);
$View = array(
  'en' => 'View',
  'fr' => 'Vue',
  'ar' => 'عرض ',
);
$Full = array(
  'en' => 'Full',
  'fr' => 'Complet',
  'ar' => 'كامل ',
);
$Classic = array(
  'en' => 'Classic',
  'fr' => 'Classique',
  'ar' => 'كلاسيكي',
);
$Hidden = array(
  'en' => 'Hidden',
  'fr' => 'Caché',
  'ar' => '',
);
$Comment_Disabled = array(
  'en' => 'Comment Disabled',
  'fr' => 'Commentaire désactivé',
  'ar' => '',
);
$Ads_Disabled  = array(
  'en' => 'Ads Disabled',
  'fr' => 'Annonces désactivées',
  'ar' => '',
);
$New_Category = array(
  'en' => 'New Category',
  'fr' => 'Nouvelle catégorie',
  'ar' => 'تصنيفة جديدة ',
);
$Theres_No_Category_To_Show = array(
  'en' => 'There\'s No Category To Show',
  'fr' => 'Il n\'y a aucune catégorie à afficher',
  'ar' => 'لا يوجد تصنيفة لعرض',
);
$Name = array(
  'en' => 'Name',
  'fr' => 'prénom',
  'ar' => 'الاسم',
);
$catégorie = array(
  'en' => 'Name',
  'fr' => 'Catégorie',
  'ar' => 'الاسم',
);
$Description = array(
  'en' => 'Description',
  'fr' => 'Description',
  'ar' => 'الوصف ',
);
$Ordering = array(
  'en' => 'Ordering',
  'fr' => 'Commande',
  'ar' => 'الترتيب ',
);
$Parent = array(
  'en' => 'Parent?',
  'fr' => 'Parent?',
  'ar' => 'الاب ',
);
$None = array(
  'en' => 'None',
  'fr' => 'Aucun',
  'ar' => 'لا شيء',
);
$ViSibility = array(
  'en' => 'ViSibility',
  'fr' => 'Visibilité',
  'ar' => 'الرؤية ',
);
$Yes = array(
  'en' => 'Yes',
  'fr' => 'Oui',
  'ar' => 'نعم ',
);
$No = array(
  'en' => 'No',
  'fr' => 'Non',
  'ar' => 'لا',
);
$Commenting = array(
  'en' => 'Commenting',
  'fr' => 'Commentaire',
  'ar' => ' تعليق ',
);
$Allow_Ads = array(
  'en' => 'Allow Ads',
  'fr' => 'Autoriser les annonces',
  'ar' => 'السماح بالإعلانات',
);
$Add_Category = array(
  'en' => 'Add Category',
  'fr' => 'Ajouter catégorie',
  'ar' => 'أضف تصنيف ',
);
$Insert_Category = array(
  'en' => 'Insert Category',
  'fr' => 'Insérer la catégorie',
  'ar' => 'إدراج التصنيفة ',
);
$Edit_Category = array(
  'en' => 'Edit Category',
  'fr' => 'Modifier la catégorie',
  'ar' => 'تحرير التصنيف',
);
$Update_Category = array(
  'en' => 'Update Category',
  'fr' => 'Mise à jour de la catégorie',
  'ar' => 'تحديث التصنيف ',
);
$Name_Of_The_Category = array(
  'en' => 'Name Of The Category',
  'fr' => 'Nom de la catégorie',
  'ar' => 'اسم التصنيف ',
);
$Describe_The_Category = array(
  'en' => 'Describe The Category',
  'fr' => 'Décrivez la catégorie',
  'ar' => 'وصف التصنيف ',
);
$Number_to_Arrange_The_Categories = array(
  'en' => 'Number to Arrange The Categories',
  'fr' => 'Numéro pour classer les catégories',
  'ar' => 'عدد ترتيب التصنيفات ',
);
$Sorry_This_Category_Is_Exist = array(
  'en' => 'Sorry This Category Is Exist',
  'fr' => 'Désolé, cette catégorie existe',
  'ar' => 'عذرا هذه التصنيفة موجودة ',
);
$Name_can_not_be_Empty = array(
  'en' => 'Name cannot be Empty ',
  'fr' => 'Le nom ne peut pas être vide',
  'ar' => 'لا يمكن أن يكون الاسم فارغا',
);
$Save = array(
  'en' => 'Save',
  'fr' => 'Enregistrer',
  'ar' => 'حفظ ',
);
$Record_Inserted = array(
  'en' => 'Record Inserted',
  'fr' => 'Enregistrer inséré',
  'ar' => 'تم التسجل ',
);
$Record_Updated = array(
  'en' => 'Record Updated',
  'fr' => 'Enregistrement mis à jour',
  'ar' => 'تم التحديث ',
);
$Delete_Category = array(
  'en' => 'Delete Category',
  'fr' => 'Supprimer la catégorie',
  'ar' => 'حذف التصنيفة ',
);
$Record_Deleted = array(
  'en' => ' Record Deleted ',
  'fr' => 'Enregistrement supprimé',
  'ar' => 'تم الحذف ',
);
$Manage_Members = array( // Memebers Page
  'en' => 'Manage Members',
  'fr' => 'Gérer les membres',
  'ar' => 'إدارة الأعضاء',
);
$Avatar = array(
  'en' => 'Avatar',
  'fr' => 'Avatar',
  'ar' => 'الصورة ',
);
$Username = array(
  'en' => 'Username',
  'fr' => 'Nom d\'utilisateur',
  'ar' => 'اسم المستخدم ',
);
$Email = array(
  'en' => 'Email',
  'fr' => 'Email',
  'ar' => 'البريد الإلكتروني ',
);
$Full_Name = array(
  'en' => 'Full Name',
  'fr' => 'Nom complet',
  'ar' => 'الاسم الكامل ',
);
$Registered_Date = array(
  'en' => 'Registered Date',
  'fr' => 'Date enregistrée',
  'ar' => 'تاريخ التسجيل ',
);
$Control = array(
  'en' => 'Control',
  'fr' => 'Contrôle',
  'ar' => 'التحكم ',
);
$Edit = array(
  'en' => 'Edit',
  'fr' => 'modifier',
  'ar' => ' تعديل ',
);
$Delete = array(
  'en' => 'Delete',
  'fr' => 'Supprimer',
  'ar' => 'حذف ',
);
$Activate = array(
  'en' => 'Activate',
  'fr' => 'Activer',
  'ar' => 'تفعيل ',
);
$Approve = array(
  'en' => 'Approve',
  'fr' => 'Approuver',
  'ar' => 'اعتمد ',
);
$New_Member = array(
  'en' => 'New Member',
  'fr' => 'Nouveau Membre',
  'ar' => 'عضو جديد ',
);
$Add_New_Member = array(
  'en' => 'Add New Member',
  'fr' => 'Ajouter membre',
  'ar' => 'إضافة عضو جديد',
);
$Password = array(
  'en' => 'Password',
  'fr' => 'Mot de passe',
  'ar' => 'كلمه السر ',
);
$User_Avatar = array(
  'en' => 'User Avatar',
  'fr' => 'Avatar de l\'utilisateur',
  'ar' => 'صورة المستخدم ',
);
$Insert_Member  = array(
  'en' => 'Insert Member',
  'fr' => 'Insérer membre',
  'ar' => 'إدراج عضو ',
);
$Edit_Member = array(
  'en' => 'Edit Member',
  'fr' => 'Editer membre',
  'ar' => 'تعديل العضو ',
);
$Update_Member = array(
  'en' => 'Update Member',
  'fr' => 'Mise à jour de membre',
  'ar' => 'تحديث العضو ',
);
$Delete_Member = array(
  'en' => 'Delete Member',
  'fr' => 'Supprimer membre',
  'ar' => 'حذف عضو ',
);
$Activate_Member = array(
  'en' => 'Activate Member',
  'fr' => 'Activer le membre',
  'ar' => 'تفعيل الأعضاء ',
);
$Leave_blank_if_you_dont_want_to_change = array(
  'en' => 'Leave blank if you don\'t want to change',
  'fr' => 'Laissez vide si vous ne voulez pas changer',
  'ar' => 'اتركها فارغاً إذا لم تريد تغييرها ',
);
$Fullnameappearinyourprofilepage = array(
  'en' => 'Full name appear in your profile page',
  'fr' => 'Le nom complet apparaît dans votre page de profil',
  'ar' => 'يظهر الاسم الكامل في صفحة ملفك الشخصي ',
);
$Usernam_cant_be_less = array(
  'en' => 'Username can\'t be less than <strong> 4 caracters</strong>',
  'fr' => 'Le nom d\'utilisateur ne peut pas comporter moins de <strong> 4 caractères </strong>',
  'ar' => ' لا يمكن أن يكون اسم المستخدم أقل من 4 أحرف ',
);
$Username_cannot_be_more = array(
  'en' => 'Username cannot be more than <strong> 20 characters </strong>',
  'fr' => 'Le nom d\'utilisateur ne peut pas contenir plus de <strong> 20 caractères </strong>',
  'ar' => 'لا يمكن أن يكون اسم المستخدم أكثر من 20 حرفا ',
);
$Username_can_not_be_Empty = array(
  'en' => 'Username can not be Empty </strong>',
  'fr' => 'Nom d\'utilisateur ne peut pas être <strong> vide </strong>',
  'ar' => 'لا يمكن أن يكون اسم المستخدم فارغا ',
);
$Password_can_not_be_Empty = array(
  'en' => 'Password can\'t be <strong> Empty </strong>',
  'fr' => 'Le mot de passe ne peut pas être <strong> vide </strong>',
  'ar' => 'لا يمكن أن تكون كلمة المرور فارغة ',
);
$Full_Name_cannot_be_Empty = array(
  'en' => 'Full Name can\'t be <strong>Empty </strong>',
  'fr' => 'Le nom complet ne peut pas être <strong> vide </strong>',
  'ar' => 'لا يمكن أن يكون الاسم الكامل فارغ ',
);
$Email_cannot_be_Empty = array(
  'en' => 'Email can\'t be <strong>Empty</strong>',
  'fr' => 'Le courrier électronique ne peut pas être <strong> vide </strong>',
  'ar' => 'لا يمكن أن يكون البريد الإلكتروني فارغا ',
);
$This_Extension_Is_Not_Allowed  = array(
  'en' => 'This Extension Is Not <strong> Allowed </strong>',
  'fr' => 'Cette extension n\'est pas <strong> autorisée </strong>',
  'ar' => 'هذا النوع غير مسموح به ',
);
$Avatar_Is_Required = array(
  'en' => 'Avatar Is <strong> Required </strong>',
  'fr' => 'Avatar est <strong> requis</strong>',
  'ar' => 'الصورة الرمزية اجباري ',
);
$Avatar_Cannot_Be_Larger_than = array(
  'en' => 'Avatar Can\'t Be Larger than <strong> 4MB </strong>',
  'fr' => 'Avatar ne peut pas être plus grand que <strong>4 Mo</strong>',
  'ar' => 'الصورة الرمزية لا يمكن أن يكون أكبر من 4 ',
);
$Sorry_This_User_Is_Exist = array(
  'en' => 'Sorry This User Is Exist',
  'fr' => 'Désolé, cet utilisateur existe',
  'ar' => 'عذرا، هذا المستخدم موجود ',
);
$Record_Inserted = array(
  'en' => 'Record Inserted',
  'fr' => 'Enregistrer inséré',
  'ar' => 'تم التسجل ',
);
$Sorry_You_Cant_Browse_This_Page_directly = array(
  'en' => 'Sorry You Cannot Browse This Page directly',
  'fr' => 'Désolé, vous ne pouvez pas parcourir cette page directement',
  'ar' => 'عذرا لا يمكنك تصفح هذه الصفحة مباشرة ',
);
$This_ID_is_not_Exist = array(
  'en' => 'This ID is not Exist',
  'fr' => 'Cette ID n\'existe pas',
  'ar' => 'هذا الرقم غير موجود ',
);
$Record_Updated = array(
  'en' => 'Record Updated',
  'fr' => 'Enregistrement mis à jour',
  'ar' => 'تم التحديث ',
);
$Record_Delete = array(
  'en' => 'Record Delete',
  'fr' => 'Supprimer l\'enregistrement',
  'ar' => 'تم الحزف ',
);
$Activated_Member = array(
  'en' => 'Activated Member',
  'fr' => 'Activé le membre',
  'ar' => 'تم التفعيل ',
);
$Username_to_login_into_shop = array(
  'en' => 'Username to login into shop',
  'fr' => 'Nom d\'utilisateur pour se connecter au eComeerce',
  'ar' => 'اسم المستخدم للدخول إلمتجر ',
);
$Password_must_be_hard_complex = array(
  'en' => 'Password must be hard & complex',
  'fr' => 'Le mot de passe doit être difficile et complexe',
  'ar' => 'يجب أن تكون كلمة المرور قوية ',
);
$Email_must_be_valid = array(
  'en' => 'Email must be valid',
  'fr' => 'L\'email doit être valide',
  'ar' => 'يجب ان يكون البريد الاكتروني صحيح ',
);
$Full_name_appear_in_your_profile_page = array(
  'en' => 'Full name appear in your profile page',
  'fr' => 'Le nom complet apparaît dans votre page de profil',
  'ar' => 'يظهر الاسم الكامل في صفحة ملفك الشخصي ',
);
$Choose_Avatar = array(
  'en' => 'Choose Avatar',
  'fr' => 'Choisissez l\'Avatar',
  'ar' => 'اختر صورة ',
);
$Manage_Items = array( // Item Page
  'en' => 'Manage Items',
  'fr' => 'Gérer les articles',
  'ar' => 'إدارة العناصر ',
);
$Photo = array(
  'en' => 'Photo',
  'fr' => 'Photo',
  'ar' => 'الصورة ',
);
$Names = array(
  'en' => 'Name',
  'fr' => 'Article',
  'ar' => 'الإ سم ',
);
$Description = array(
  'en' => 'Description',
  'fr' => 'Description',
  'ar' => 'الوصف ',
);
$Price = array(
  'en' => 'Price',
  'fr' => 'Prix',
  'ar' => 'السعر ',
);
$Adding_Date = array(
  'en' => 'Adding Date',
  'fr' => 'Ajout de la date',
  'ar' => 'تاريخ الإضافة ',
);
$Category = array(
  'en' => 'Category',
  'fr' => 'Catégorie',
  'ar' => 'القسم ',
);
$Username = array(
  'en' => 'Username',
  'fr' => 'Nom d\'utilisateur',
  'ar' => 'اسم المستخدم ',
);
$Control = array(
  'en' => 'Control',
  'fr' => 'Contrôle',
  'ar' => 'التحكم ',
);
$New_Item  = array(
  'en' => 'New Item ',
  'fr' => 'Nouvel article',
  'ar' => 'عنصر جديد ',
);
$Add_New_Item = array(
  'en' => 'Add New Item',
  'fr' => 'Ajouter un nouvel article',
  'ar' => 'إضافة عنصر جديد ',
);
$Itsert_Item = array(
  'en' => 'Insert Item',
  'fr' => 'Itsert article',
  'ar' => 'تم اضافة العنصر ',
);
$Name_Of_The_Item = array(
  'en' => 'Name Of The Item',
  'fr' => 'Nom de l\'article',
  'ar' => 'اسم العنصر ',
);
$Description_of_the_item = array(
  'en' => 'Description of the item',
  'fr' => 'Description de l\'article',
  'ar' => 'وصف العنصر ',
);
$Price_of_the_item = array(
  'en' => 'Price of the item',
  'fr' => 'Prix de l\'article',
  'ar' => 'سعر السلعة ',
);
$Country = array(
  'en' => 'Country',
  'fr' => 'Pays',
  'ar' => 'البلد ',
);
$Country_of_Mede = array(
  'en' => 'Country of Mede',
  'fr' => 'Pays de Mede',
  'ar' => 'بلد الصنع ',
);
$Status = array(
  'en' => 'Status',
  'fr' => 'Status',
  'ar' => 'الحالة ',
);
$New = array(
  'en' => 'New',
  'fr' => 'Nouveau',
  'ar' => 'جديد ',
);
$Like_New = array(
  'en' => 'Like New',
  'fr' => 'Comme neuf',
  'ar' => 'مثل جديد ',
);
$Used = array(
  'en' => 'Used',
  'fr' => 'Utilisé',
  'ar' => 'مستخدم ',
);
$Very_Old = array(
  'en' => 'Very Old',
  'fr' => 'Très vieux',
  'ar' => 'قديم جدا ',
);
$Member = array(
  'en' => 'Member',
  'fr' => 'Membre',
  'ar' => 'العضو ',
);
$Tags = array(
  'en' => 'Tags',
  'fr' => 'Mots clés',
  'ar' => 'الوسم ',
);
$Separate_Tags_With_Comma = array(
  'en' => 'Separate Tags With Comma',
  'fr' => 'Etiquettes séparées avec des virgules',
  'ar' => 'فصل الوسم بي فاصلة ',
);
$Add_Item = array(
  'en' => 'Add Item',
  'fr' => 'Ajouter l\'article',
  'ar' => 'اضافة عنصر ',
);
$Insert_Item = array(
  'en' => 'Insert Item',
  'fr' => 'Insérer un article',
  'ar' => 'إدراج العنصر ',
);
$Name_cannot_be_Empty = array(
  'en' => 'Name cannot be <strong>Empty</strong>',
  'fr' => 'Le nom ne peut pas être <strong>vide</strong>',
  'ar' => 'لا يمكن أن يكون الاسم فارغا',
);
$Description_cannot_be_Empty = array(
  'en' => 'Description cannot be <strong>Empty</strong>',
  'fr' => 'La description ne peut pas être <strong>vide</strong>',
  'ar' => 'لا يمكن أن يكون الوصف فارغا ',
);
$Price_cannot_be_Empty = array(
  'en' => 'Price cannot be <strong>Empty</strong>',
  'fr' => 'Le prix ne peut pas être <strong>vide</strong>',
  'ar' => 'لا يمكن أن يكون السعر فارغا ',
);
$Country_cannot_be_Empty = array(
  'en' => 'Country cannot be <strong>Empty</strong>',
  'fr' => 'Le pays ne peut pas être <strong>vide</strong>',
  'ar' => 'لا يمكن أن يكون البلد فارغا ',
);
$You_must_choose_the_Status = array(
  'en' => 'You must choose <strong> the Status</strong>',
  'fr' => 'Vous devez choisir <strong>le statut</strong>',
  'ar' => 'يجب عليك اختيار الحالة ',
);
$You_must_choose_the_Member = array(
  'en' => 'You must choose <strong>the Member</strong>',
  'fr' => 'Vous devez choisir <strong>le Membre</strong></strong>',
  'ar' => 'يجب عليك اختيار العضو ',
);
$You_must_choose_the_Category = array(
  'en' => 'You must choose <strong>the Category</strong>',
  'fr' => 'Vous devez choisir <strong>la catégorie</strong>',
  'ar' => 'يجب عليك اختيار الفئة ',
);
$Edit_Item = array(
  'en' => 'Edit Item',
  'fr' => 'Modifier l\'article',
  'ar' => 'تعديل العنصر ',
);
$Update_Item = array(
  'en' => 'Update Item',
  'fr' => 'Mise à jour d\'Article',
  'ar' => 'تحديث العنصر ',
);
$Delete_Item = array(
  'en' => 'Delete Item',
  'fr' => 'Supprimer l\'article',
  'ar' => 'حذف العنصر ',
);
$Approve_Item = array(
  'en' => 'Approve Item',
  'fr' => 'approuver l\'article',
  'ar' => 'الموافقة على العنصر ',
);
$Manage_Comments = array( //Comments Page
  'en' => 'Manage Comments',
  'fr' => 'Gérer les commentaires',
  'ar' => 'إدارة التعليقات ',
);
$Comment = array(
  'en' => 'Comment',
  'fr' => 'Commentaire',
  'ar' => 'التعليق ',
);
$Item_Name = array(
  'en' => 'Item Name',
  'fr' => 'Nom de l\'article',
  'ar' => 'اسم العنصر ',
);
$User_Name = array(
  'en' => 'Username',
  'fr' => 'Nom d\'utilisateur',
  'ar' => 'اسم المستخدم ',
);
$Add_Date = array(
  'en' => 'Add Date',
  'fr' => 'Ajouter une date',
  'ar' => 'تاريخ الإضافة ',
);
$Edit_Comment = array(
  'en' => 'Edit Comment',
  'fr' => 'Modifier le commentaire',
  'ar' => 'تحرير التعليق ',
);
$Delete_Comment = array(
  'en' => 'Delete Comment',
  'fr' => 'Supprimer',
  'ar' => 'حذف التعليق ',
);
$Record_Approved = array(
  'en' => 'Record Approved',
  'fr' => 'Enregistrement approuvé',
  'ar' => 'تم التسجيل ',
);

 ?>
