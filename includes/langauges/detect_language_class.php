<?php



if (!(isset($_SESSION))) session_start();


//Vérifier si une langue été mise en
if (isset($_GET['lang'])){
		$_GET['lang'] = $_GET['lang'];
	} elseif (isset($_SESSION['user_language_choice'])){
		$_GET['lang'] = $_SESSION['user_language_choice'];
	} else{
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
$Search = array(
	'en' => 'Search ...',
	'fr' => 'Chercher ...',
	'ar' => 'بحث ',
	);
$Elgadah = array(
	'en' => 'Elgadah',
	'fr' => 'Elgadah',
	'ar' => 'القدح',
	);
$Welcome = array(
	'en' => 'Profile',
	'fr' => 'Profil',
	'ar' => 'Welcome',
);
$My_Profile = array(
	'en' => 'My Profile',
	'fr' => 'Mon profil',
	'ar' => 'صفحتي الشخصية ',
);
$New_Item = array(
  'en' => 'New Item',
  'fr' => 'Nouvel article',
  'ar' => 'عنصر جديد ',
);
$My_Items = array(
  'en' => 'My Items',
  'fr' => 'Mes Articles',
  'ar' => 'منشوراتي ',
);
$New_Ad = array(
  'en' => 'New Ad',
  'fr' => 'Nouvelle annonce',
  'ar' => 'إعلان جديد',
);
$Logout = array(
  'en' => 'Logout',
  'fr' => 'Déconnecter',
  'ar' => 'تسجيل الخروج ',
);
$Login= array(
  'en' => 'Login',
  'fr' => 'Connexion',
  'ar' => 'تسجيل الدخول ',
);
$Signup = array(
  'en' => 'Signup',
  'fr' => 'Inscrivez-vous',
  'ar' => 'اشترك ',
);
$Logout = array(
  'en' => 'Logout',
  'fr' => 'Déconnecter',
  'ar' => 'تسجيل الخروج ',
);
$My_information= array( // Profile Page
  'en' => 'My informations',
  'fr' => 'Mes informations',
  'ar' => 'معلوماتي ',
);
$Login_Name= array(
  'en' => 'Login Name',
  'fr' => 'identifiant',
  'ar' => 'اسم تسجيل الدخول ',
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
$Register_Date = array(
  'en' => 'Register Date',
  'fr' => 'Date du registrée',
  'ar' => 'تاريخ التسجيل ',
);
$Favourite = array(
  'en' => 'Favourite',
  'fr' => 'Préféré',
  'ar' => 'المفضلة ',
);
$Edit_Info= array(
  'en' => 'Edit Info',
  'fr' => 'Modifier',
  'ar' => 'تعديل ',
);
$Delete = array(
  'en' => 'Delete',
  'fr' => 'Supprimer',
  'ar' => 'حذف ',
);
$Latest_comments= array (
  'en' => 'Latest comments',
  'fr' => 'Derniers commentaires',
  'ar' => 'أحدث التعليقات ',
);
$Edit_Informations = array(
  'en' => 'Edit Informations',
  'fr' => 'Modifier les informations',
  'ar' => 'تعديل المعلومات ',
);
$Username = array(
  'en' => 'Username',
  'fr' => 'Nom d\'utilisateur',
  'ar' => 'اسم المستخدم ',
);
$Password = array(
  'en' => 'Password',
  'fr' => 'Mot de passe',
  'ar' => 'كلمة المرور ',
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
$User_Avatar = array(
  'en' => 'User Avatar',
  'fr' => 'Avatar de l\'utilisateur',
  'ar' => 'صورة المستخدم ',
);
$Save = array(
  'en' => 'Save',
  'fr' => 'Enregistrer',
  'ar' => 'احفظ ',
);
$Update_Member  = array(
  'en' => 'Update Member ',
  'fr' => 'Mettre à jour le membre',
  'ar' => 'تحديث العضو ',
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
$Informations_Edited_Login_to_Enjoy = array(
  'en' => 'Informations Edited Login to Enjoy',
  'fr' => 'Informations éditées Reconnectez-vous pour profiter',
  'ar' => 'تم تحديث المعلومات ',
);
$Sorry_You_Cant_Browse_This_Page_directly = array(
  'en' => 'Sorry You Cannot Browse This Page directly',
  'fr' => 'Désolé, vous ne pouvez pas parcourir cette page directement',
  'ar' => 'عذرا لا يمكنك تصفح هذه الصفحة مباشرة ',
);
$Delete_Member = array(
  'en' => 'Delete Member',
  'fr' => 'Supprimer membre',
  'ar' => 'حذف عضو ',
);
$Record_Deleted = array(
  'en' => ' Record Deleted ',
  'fr' => 'Enregistrement supprimé',
  'ar' => 'تم الحذف ',
);
$Theres_No_Items_To_Show = array(
  'en' => 'There\'s No Items To Show',
  'fr' => 'Il n\'y a aucun élément à afficher',
  'ar' => 'لا توجد عناصر للعرض',
);
$This_ID_is_not_Exist = array(
  'en' => 'This ID is not Exist',
  'fr' => 'Cette ID n\'existe pas',
  'ar' => 'هذا الرقم غير موجود ',
);
$Theres_No_Comments_To_Show = array(
  'en' => 'There\'s No Comments To Show',
  'fr' => 'Il n\'y a pas de commentaire à afficher',
  'ar' => 'ليس هناك تعليقات للعرض ',
);
$Sorry_Theres_No_Items_To_Show_Create = array(
  'en' => 'Sorry There\'s No Items To Show, Create',
  'fr' => 'Désolé, il n\'y a aucun élément à afficher, Créer',
  'ar' => 'عذرا لا توجد عناصر لعرض، إنشاء ',
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
$Item_Added  = array(
  'en' => 'Item Added ',
  'fr' => 'Article ajouté',
  'ar' => 'تمت إضافة العنصر ',
);
$Photo = array(
  'en' => 'Photo',
  'fr' => 'Photo',
  'ar' => 'الصورة ',
);
$Name = array(
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
$New_Item  = array( // New Item Page
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
$Title  = array(
  'en' => 'Title',
  'fr' => 'Titre',
  'ar' => 'العنوان ',
);
$This_Field_Required_At_Least_Characters = array(
  'en' => 'This Field Required At Least 4 Characters',
  'fr' => 'Ce champ nécessite au moins 4 caractères',
  'ar' => 'هذا الحقل مطلوب على الأقل 4 أحرف ',
);
$This_Field_Must_Be_Least_Characters = array(
  'en' => 'This Field Must Be Least 2 Characters',
  'fr' => 'Ce champ doit être au moins 2 caractères',
  'ar' => 'يجب أن يكون هذا الحقل حرفين على الأقل ',
);
$Image = array(
  'en' => 'Image',
  'fr' => 'Image',
  'ar' => 'الصورة ',
);
$Categories = array(
  'en' => 'Categories',
  'fr' => 'Catégories',
  'ar' => 'الاقسام',
);
$Create_New_Item = array(
  'en' => 'Create New Item',
  'fr' => 'Créer un nouvel article',
  'ar' => 'إنشاء عنصر جديد',
);
$Name_Of_The_Item = array(
  'en' => 'Name Of The Item',
  'fr' => 'Nom de l\'article',
  'ar' => 'اسم العنصر ',
);
$Country_of_Mede = array(
  'en' => 'Country of Mede',
  'fr' => 'Pays de Mede',
  'ar' => 'بلد الصنع ',
);
$Informations_Item = array( // Item Page
  'en' => 'Informations Item',
  'fr' => 'Informations Article',
  'ar' => 'معلومات العنصر ',
);
$Added_Date = array(
  'en' => 'Added Date',
  'fr' => 'Date ajoutée',
  'ar' => 'تاريخ الإضافة ',
);
$Price = array(
  'en' => 'Price',
  'fr' => 'Prix',
  'ar' => 'السعر ',
);
$Made_In = array(
  'en' => 'Made In',
  'fr' => 'Fabriqué en',
  'ar' => 'صنع في ',
);
$Category = array(
  'en' => 'Category',
  'fr' => 'Catégorie',
  'ar' => 'القسم ',
);
$Tags = array(
  'en' => 'Tags',
  'fr' => 'Mots clés',
  'ar' => 'الوسم ',
);
$Add_Your_Comment = array(
  'en' => 'Add Your Comment',
  'fr' => 'Ajoutez votre commentaire',
  'ar' => 'أضف تعليق',
);
$Add_Comment = array(
  'en' => 'Add Comment',
  'fr' => 'Ajouter un commentaire',
  'ar' => 'أضف تعليق',
);
$Or = array(
  'en' => 'Or',
  'fr' => 'Ou',
  'ar' => 'أو',
);
$Register  = array(
  'en' => 'Register',
  'fr' => 'S\'inscrire',
  'ar' => 'سجل ',
);
$To_Add_Comments = array(
  'en' => 'To Add Comments',
  'fr' => 'Pour ajouter des commentaires',
  'ar' => 'لإضافة تعليق',
);
$Theres_NoSuchIDOrThisItemIsAwaitingApproval = array(
  'en' => 'There\'s No Such ID Or This Item Is Awaiting Approval',
  'fr' => 'Il n\'y a pas ID ou cet article est en attente d\'approbation',
  'ar' => 'لا يوجد اسم ، أو هذا العنصر في انتظار الموافقة ',
);
$Comment_Added = array(
  'en' => 'Comment Added, Waiting Approval',
  'fr' => 'Commentaire ajouté, Attendre l\'approbation',
  'ar' => 'تم إضافة التعليق، في انتظار التفعيل ',
);
$You_Must_Add_Comment = array(
  'en' => 'You Must Add Comment',
  'fr' => 'Vous devez ajouter un commentaire',
  'ar' => 'يجب عليك إضافة تعليق ',
);
$Profile = array(
  'en' => 'Profile',
  'fr' => 'Profil',
  'ar' => 'الملف الشخصي لي ',
);
$Informations = array(
  'en' => 'Informations',
  'fr' => 'informations',
  'ar' => 'معلومات  ',
);
$The_Message_Must_Be_Between_Characters = array(
  'en' => 'The Message Must Be Between 4 & 60 Characters',
  'fr' => 'Le message doit être entre 4 et 60 Caractères',
  'ar' => 'يجب أن تكون الرسالة بين 4 و 40 حرفا ',
);
$Username_Must_Be_Between_Characters  = array( // Login Page
  'en' => 'Username Must Be Between 4 & 6 Characters ',
  'fr' => 'Le nom d\'utilisateur doit être entre 4 et 6 caractères',
  'ar' => 'يجب أن يكون اسم المستخدم بين 4 و 6 أحرف ',
);
$Sorry_Password_Cant_Be_Empty  = array(
  'en' => 'Sorry Password Cannot Be Empty ',
  'fr' => 'Désolé, le mot de passe ne peut pas être vide',
  'ar' => 'عذرا، لا يمكن ترك كلمة المرور فارغة',
);
$Sorry_Password_Is_Not_Match  = array(
  'en' => 'Sorry Password Is Not Match ',
  'fr' => 'Désolé, le mot de passe ne correspond pas',
  'ar' => 'عذرا، كلمة المرور غير متطابقة ',
);
$Sorry_Email_Cant_Be_Empty_Or_Not_Valid  = array(
  'en' => 'Sorry Email Cannot Be Empty Or Not Valid',
  'fr' => 'Désolé, le courrier électronique ne peut pas être vide ou non valide',
  'ar' => 'عفوا البريد الإلكتروني لا يمكن أن تكون فارغة أو غير صالحة ',
);
$Sorry_This_User_IS_Exists  = array(
  'en' => 'Sorry This User IS Exists ',
  'fr' => 'Désolé, ce nom existe',
  'ar' => 'عذرا، هذا المستخدم موجود ',
);
$Congrats_You_Are_Now_Registrd_User  = array(
  'en' => 'Congrats You Are Now Registered User ',
  'fr' => 'Félicitations, vous êtes maintenant inscrits',
  'ar' => 'تهانينا أنت الآن مسجل ',
);
$Type_your_username = array(
  'en' => 'Type your username',
  'fr' => 'Tapez votre nom d\'utilisateur',
  'ar' => 'اكتب اسم المستخدم ',
);
$Type_your_password = array(
  'en' => 'Type your password',
  'fr' => 'Tapez votre mot de passe',
  'ar' => 'اكتب كلمة المرور ',
);
$Type_complex_password = array(
  'en' => 'Type a complex password ',
  'fr' => 'Tapez un mot de passe complexe',
  'ar' => 'اكتب كلمة مرور معقدة ',
);
$Type_password_again = array(
  'en' => 'Type a password again',
  'fr' => 'Tapez à nouveau un mot de passe',
  'ar' => 'اكتب كلمة المرور مرة أخرى ',
);
$Your_Email_Appear_in_Your_Profile = array(
  'en' => 'Your Email Appear in Your Profile',
  'fr' => 'Votre Email apparaît dans votre profil ',
  'ar' => 'يظهر بريدك الإلكتروني في ملفك الشخصي ',
);
$Show_Category_Items= array(
  'en' => 'Show Category Items',
  'fr' => 'les éléments de la catégorie',
  'ar' => 'عرض عناصر القسم ',
);
$Added_By = array(
  'en' => 'Added By',
  'fr' => 'Ajouté par',
  'ar' => 'اضيف بواسطة ',
);
$Waiting_Approval = array(
  'en' => 'Waiting Approval',
  'fr' => 'Attendre l\'approbation',
  'ar' => 'في انتظار الموافقة ',
);
$Waiting_Approval_you_cant_show_it = array(
  'en' => 'Waiting Approval You Cant Show It',
  'fr' => 'Attendre l\'approbation vous ne pouvez pas le voir',
  'ar' => 'في انتظار الموافقة ',
);
$Sorry_No_result = array( // search page
  'en' => 'Sorry No Result',
  'fr' => 'Désolé, aucun résultat',
  'ar' => 'عذرا لا نتائج',
);
$Result_of_search  = array( // search page
  'en' => 'Results of Search',
  'fr' => 'Résultats de la recherche',
  'ar' => 'نتائج البحث ',
);




 ?>
