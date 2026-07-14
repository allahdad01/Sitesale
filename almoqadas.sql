-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2026 at 08:43 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almoqadas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL COMMENT 'bcrypt hash',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@almoqadas.com', '$2y$12$Lg06OwGdz21rBboLVJAVPeaU15gkhb249o1SvtxrIJiuIyXY/NQTS', '2026-06-30 07:48:17', '2026-06-30 07:48:17');

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` varchar(120) NOT NULL DEFAULT '',
  `label_en` varchar(120) NOT NULL DEFAULT '',
  `label_ps` varchar(120) NOT NULL DEFAULT '',
  `label_fa` varchar(120) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `image`, `label`, `label_en`, `label_ps`, `label_fa`, `sort_order`, `active`, `created_at`) VALUES
(1, 'https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=400', 'Al-Khomri Partnership', 'Al-Khomri Partnership', 'الخمری مشارکت', 'همکاری الخمری', 0, 1, '2026-07-01 07:35:09'),
(2, 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400', 'Kam Air Award 2020', 'Kam Air Award 2020', 'د کام ایر جایزه ۲۰۲۰', 'جایزه کام ایر ۲۰۲۰', 1, 1, '2026-07-01 07:35:09'),
(3, 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400', '20+ Years Serving', '20+ Years Serving', 'له ۲۰ کلونو څخه زیات خدمت', 'بیش از ۲۰ سال خدمت', 2, 1, '2026-07-01 07:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_ref` varchar(20) NOT NULL,
  `package_id` int(10) UNSIGNED DEFAULT NULL,
  `package_title` varchar(200) DEFAULT NULL,
  `full_name` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `group_size` int(11) NOT NULL DEFAULT 1,
  `service` varchar(60) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `status` enum('pending','confirmed','completed','cancelled') NOT NULL DEFAULT 'pending',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_ref`, `package_id`, `package_title`, `full_name`, `phone`, `email`, `travel_date`, `group_size`, `service`, `message`, `admin_notes`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 'BK-2607-0001', 1, '7-Day Premium Umrah Package', 'ROHULLAH SAFI', '+93786011115', 'almuqadas_travel@yahoo.com', '2026-07-18', 3, 'umrah', 'test', NULL, 'completed', '::1', '2026-07-02 07:07:27', '2026-07-02 07:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE `enquiries` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(120) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `service` varchar(60) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('pending','read','replied') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `question_en` varchar(255) NOT NULL DEFAULT '',
  `question_ps` varchar(255) NOT NULL DEFAULT '',
  `question_fa` varchar(255) NOT NULL DEFAULT '',
  `answer` text NOT NULL,
  `answer_en` text NOT NULL,
  `answer_ps` text NOT NULL,
  `answer_fa` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `question_en`, `question_ps`, `question_fa`, `answer`, `answer_en`, `answer_ps`, `answer_fa`, `sort_order`, `active`, `created_at`) VALUES
(1, 'What documents do I need for Umrah?', 'What documents do I need for Umrah?', 'د عمرې لپاره کوم اسناد ته اړتیا لرم؟', 'برای عمره چه مدارکی نیاز دارم؟', 'You need a valid passport (6+ months validity), passport-size photos, and a completed visa application form. We handle the rest.', 'You need a valid passport (6+ months validity), passport-size photos, and a completed visa application form. We handle the rest.', 'تاسو معتبر پاسپورت (لږ تر لږه ۶ میاشتې اعتبار)، د پاسپورت عکسونه او بشپړ شوی د ویزې غوښتنلیک فورمه ته اړتیا لرئ. موږ ستاسو لپاره د ثبت پروسه بشپړه کوو.', 'شما به پاسپورت معتبر (حداقل ۶ ماه اعتبار)، عکس پاسپورتی و فرم درخواست ویزای تکمیل شده نیاز دارید. ما تمام مراحل ثبت نام را برای شما انجام می‌دهیم.', 0, 1, '2026-07-05 04:39:34'),
(2, 'How far in advance should I book?', 'How far in advance should I book?', 'څومره مخکې باید بک کړم؟', 'چقدر زودتر باید رزرو کنم؟', 'We recommend booking at least 4–6 weeks before your desired travel date, especially during peak seasons like Ramadan.', 'We recommend booking at least 4–6 weeks before your desired travel date, especially during peak seasons like Ramadan.', 'موږ سپارښتنه کوو چې لږ تر لږه ۴-۶ اونۍ مخکې د خپل مطلوب سفر نیټې څخه بک کړئ، په ځانګړې توګه د رمضان په څیر په بوخت موسمونو کې.', 'توصیه می‌کنیم حداقل ۴ تا ۶ هفته قبل از تاریخ سفر مورد نظر خود رزرو کنید، به ویژه در فصول شلوغ مانند ماه رمضان.', 1, 1, '2026-07-05 04:39:34'),
(3, 'Do you offer group discounts?', 'Do you offer group discounts?', 'آیا د ډلې تخفیفونه وړاندې کوئ؟', 'آیا تخفیف گروهی دارید؟', 'Yes! We offer special rates for groups of 5 or more travelers. Contact us for a custom group quote.', 'Yes! We offer special rates for groups of 5 or more travelers. Contact us for a custom group quote.', 'هو! موږ د ۵ یا ډیرو مسافرانو لپاره ځانګړي نرخونه لرو. د دودیزې ډلې نرخ لپاره موږ سره اړیکه ونیسئ.', 'بله! ما قیمت‌های ویژه برای گروه‌های ۵ نفر یا بیشتر داریم. برای دریافت قیمت گروهی سفارشی با ما تماس بگیرید.', 2, 1, '2026-07-05 04:39:34'),
(4, 'Can I customize my package?', 'Can I customize my package?', 'آیا کوالی شم خپله بسته دودیزه کړم؟', 'آیا می‌توانم بسته خود را سفارشی کنم؟', 'Absolutely. Every package can be tailored to your preferences — hotel star rating, meal plans, extra city tours, and more.', 'Absolutely. Every package can be tailored to your preferences — hotel star rating, meal plans, extra city tours, and more.', 'بالکل. هره بسته ستاسو د غوره توبونو سره سم تنظیم کیدی شي — د هوټل ستوري درجه، د خواړو پلان، اضافي ښاري سفرونه او نور.', 'کاملاً. هر بسته می‌تواند مطابق با نیازهای شما تنظیم شود — ستاره هتل، وعده‌های غذایی، گشت‌های اضافی شهری و موارد دیگر.', 3, 1, '2026-07-05 04:39:34'),
(5, 'What payment methods do you accept?', 'What payment methods do you accept?', 'کومې تادیې میتودونه منئ؟', 'چه روش‌های پرداختی را قبول می‌کنید؟', 'We accept bank transfers, cash payments at our office, and mobile money transfers. Contact us for details.', 'We accept bank transfers, cash payments at our office, and mobile money transfers. Contact us for details.', 'موږ بانکي حوالې، زموږ په دفتر کې نغدي تادیه او موبایل پیسې حوالې منو. د جزیاتو لپاره موږ سره اړیکه ونیسئ.', 'ما انتقال بانکی، پرداخت نقدی در دفتر ما و انتقال پول موبایلی را قبول می‌کنیم. برای جزئیات با ما تماس بگیرید.', 4, 1, '2026-07-05 04:39:34');

-- --------------------------------------------------------

--
-- Table structure for table `hero_slides`
--

CREATE TABLE `hero_slides` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` varchar(120) NOT NULL DEFAULT '',
  `label_en` varchar(120) NOT NULL DEFAULT '',
  `label_ps` varchar(120) NOT NULL DEFAULT '',
  `label_fa` varchar(120) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hero_slides`
--

INSERT INTO `hero_slides` (`id`, `image`, `label`, `label_en`, `label_ps`, `label_fa`, `sort_order`, `active`, `created_at`) VALUES
(1, 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400', 'Dubai', 'Dubai', 'دوبۍ', 'دبی', 0, 1, '2026-07-01 07:22:30'),
(2, 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400', 'Istanbul', 'Istanbul', 'استانبول', 'استانبول', 1, 1, '2026-07-01 07:22:30'),
(3, 'https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=400', 'Kabul', 'Kabul', 'کابل', 'کابل', 2, 1, '2026-07-01 07:22:30'),
(4, 'https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=400', 'Kuala Lumpur', 'Kuala Lumpur', 'کوالالامپور', 'کوالالامپور', 3, 1, '2026-07-01 07:22:30'),
(5, 'https://commons.wikimedia.org/wiki/Special:FilePath/Al_Masjid_An-Nabawi.jpg?width=400', 'Medina', 'Medina', 'مدینه', 'مدینه', 4, 1, '2026-07-01 07:22:30'),
(6, 'https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=400', 'London', 'London', 'لندن', 'لندن', 5, 1, '2026-07-01 07:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `title_en` varchar(200) NOT NULL DEFAULT '',
  `title_ps` varchar(200) NOT NULL DEFAULT '',
  `title_fa` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `description_en` text DEFAULT NULL,
  `description_ps` text DEFAULT NULL,
  `description_fa` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `duration_days` int(11) NOT NULL DEFAULT 1,
  `max_people` int(11) NOT NULL DEFAULT 1,
  `category` varchar(60) NOT NULL DEFAULT 'tour' COMMENT 'hajj, umrah, tour, flight, visa, hotel',
  `destination` varchar(120) DEFAULT NULL,
  `destination_en` varchar(120) NOT NULL DEFAULT '',
  `destination_ps` varchar(120) NOT NULL DEFAULT '',
  `destination_fa` varchar(120) NOT NULL DEFAULT '',
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `title_en`, `title_ps`, `title_fa`, `slug`, `description`, `description_en`, `description_ps`, `description_fa`, `image`, `price`, `duration_days`, `max_people`, `category`, `destination`, `destination_en`, `destination_ps`, `destination_fa`, `featured`, `active`, `created_at`, `updated_at`) VALUES
(1, '8-Day Premium Umrah Package', '8-Day Premium Umrah Package', 'د ۷ ورځو پریمیم عمره بسته', 'بسته عمره ممتاز ۷ روزه', '7-day-premium-umrah-package', '<h3>Experience a Blessed Umrah Journey</h3><p>Our premium Umrah package includes 5-star accommodation near the Haram in both Makkah and Madinah, private transport, and a dedicated guide throughout your stay.</p><ul><li>Return flights from Kabul</li><li>Visa processing included</li><li>5 nights in Makkah (5-star)</li><li>3 nights in Madinah (5-star)</li><li>Daily breakfast and dinner</li><li>Private guide and transporter</li></ul>', '<h3>Experience a Blessed Umrah Journey</h3><p>Our premium Umrah package includes 5-star accommodation near the Haram in both Makkah and Madinah, private transport, and a dedicated guide throughout your stay.</p><ul><li>Return flights from Kabul</li><li>Visa processing included</li><li>5 nights in Makkah (5-star)</li><li>3 nights in Madinah (5-star)</li><li>Daily breakfast and dinner</li><li>Private guide and transporter</li></ul>', '<h3>د یوه برکتناک عمره سفر تجربه کړئ</h3><p>زموږ پریمیم عمره بسته په مکه او مدینه کې د حرم سره نږدې ۵ ستوري هوټل، د لومړۍ درجې الوتنې، او تجربه لرونکي لارښودان شاملوي. د رسیدو څخه تر راستنیدو پورې، ټول جزئیات ستاسو لپاره مدیریت کیږي.</p><ul><li>د ۷ شپو ۵ ستوري هوټل استوګنه</li><li>رفت و آمد الوتنه</li><li>د عمرې بشپړ ویزه</li><li>د هوټل څخه هوټل ته ترانسپورت</li><li>تجربه لرونکی لارښود</li><li>ورځنی ناشته او ډوډۍ</li></ul><p>د هر کس څخه $۱,۸۹۹ پیل</p>', '<h3>یک سفر عمره پربرکت را تجربه کنید</h3><p>بسته عمره ممتاز ما شامل اقامت ۵ ستاره نزدیک حرم در مکه و مدینه، حمل و نقل با هواپیماهای درجه یک، و راهنمایان مجرب که در هر مرحله شما را همراهی می‌کنند، می‌باشد. از لحظه ورود تا بازگشت، همه جزئیات برای شما مدیریت می‌شود.</p><ul><li>اقامت ۷ شب در هتل ۵ ستاره</li><li>پرواز رفت و برگشت</li><li>ویزای کامل عمره</li><li>حمل و نقل فرودگاهی</li><li>راهنمای مجرب</li><li>صبحانه و شام روزانه</li></ul><p>شروع از $۱,۸۹۹ هر نفر</p>', 'image_08fce6159f1576d6.png', 2499.00, 7, 10, 'umrah', 'Saudi Arabia', 'Saudi Arabia', 'سعودي عربستان', 'عربستان سعودی', 1, 1, '2026-06-30 08:13:21', '2026-07-14 05:13:24'),
(2, '12-Day Hajj Package', '12-Day Hajj Package', 'د ۱۲ ورځو حج بسته', 'بسته حج ۱۲ روزه', '12-day-hajj-package', '<h3>Complete Hajj Experience</h3><p>Our comprehensive Hajj package covers every aspect of your pilgrimage with premium services and experienced guides.</p><ul><li>Return flights</li><li>Visa processing</li><li>Accommodation in Mina, Arafat, Muzdalifah</li><li>Experienced Hajj guide</li><li>Transportation throughout</li><li>Meals included</li></ul>', '<h3>Complete Hajj Experience</h3><p>Our comprehensive Hajj package covers every aspect of your pilgrimage with premium services and experienced guides.</p><ul><li>Return flights</li><li>Visa processing</li><li>Accommodation in Mina, Arafat, Muzdalifah</li><li>Experienced Hajj guide</li><li>Transportation throughout</li><li>Meals included</li></ul>', '<h3>د حج بشپړ تجربه</h3><p>زموږ جامع حج بسته ستاسو د معنوي سفر ټول اړخونه د عالي خدماتو سره پوښي. د حرم سره نږدې هوټلونو څخه نیولې تر ترانسپورت او د حج د مناسکو لارښودنې پورې، موږ ستاسو تر څنګ یو.</p><ul><li>د حرم سره نږدې د ۱۲ شپو استوګنه</li><li>رفت و آمد الوتنه</li><li>تجربه لرونکی حج لارښود</li><li>د مناسکو ترمنځ ترانسپورت</li><li>خواړه</li><li>د اداري چارو او ویزې مرسته</li></ul>', '<h3>تجربه کامل حج</h3><p>بسته جامع حج ما تمام جنبه‌های سفر معنوی شما را با خدمات ممتاز پوشش می‌دهد. از اقامت در هتل‌های نزدیک حرم تا حمل و نقل و راهنمایی در مناسک حج، ما در کنار شما هستیم.</p><ul><li>اقامت ۱۲ شب در هتل‌های نزدیک حرم</li><li>پرواز رفت و برگشت</li><li>راهنمای مجرب حج</li><li>حمل و نقل بین مناسک</li><li>وعده‌های غذایی</li><li>کمک در امور اداری و صدور ویزا</li></ul>', NULL, 5999.00, 12, 15, 'hajj', 'Saudi Arabia', 'Saudi Arabia', 'سعودي عربستان', 'عربستان سعودی', 1, 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29'),
(3, '5-Day Dubai Family Tour', '5-Day Dubai Family Tour', 'د ۵ ورځو کورنۍ دوبۍ سفر', 'تور ۵ روزه خانوادگی دبی', '5-day-dubai-family-tour', '<h3>Explore the City of Gold</h3><p>A family-friendly Dubai package featuring top attractions, shopping, and desert adventures.</p><ul><li>Return flights</li><li>4-star hotel with breakfast</li><li>Desert safari</li><li>Burj Khalifa visit</li><li>City tour</li><li>Transfers</li></ul>', '<h3>Explore the City of Gold</h3><p>A family-friendly Dubai package featuring top attractions, shopping, and desert adventures.</p><ul><li>Return flights</li><li>4-star hotel with breakfast</li><li>Desert safari</li><li>Burj Khalifa visit</li><li>City tour</li><li>Transfers</li></ul>', '<h3>د سرو زرو ښار وپلټئ</h3><p>د کورنۍ لپاره د دوبۍ بسته د غوره جاذبو، پیرود او دښتې ساہسک سره. د کورنۍ د ټولو غړو لپاره مناسب.</p><p>شامل دي: ۴ ستوري هوټل، د برج خلیفه ټ�کټ، دښتې ساہسک، ښاري سفر او د هوټل ترانسپورت.</p>', '<h3>شهر طلا را کاوش کنید</h3><p>یک بسته خانوادگی دبی با جاذبه‌های برتر، خرید و ماجراجویی در بیابان. مناسب برای تمام اعضای خانواده.</p><p>شامل: هتل ۴ ستاره، بلیط برج خلیفه، سافاری بیابانی، گشت شهری و ترانسفر فرودگاهی.</p>', NULL, 1299.00, 5, 8, 'tour', 'Dubai', 'Dubai', 'دوبۍ', 'دبی', 1, 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29'),
(4, 'Visa Processing Service', 'Visa Processing Service', 'د ویزې پروسس خدمتونه', 'خدمات صدور ویزا', 'visa-processing-service', '<p>Hassle-free visa processing for Saudi Arabia, UAE, Turkey, and more. We handle all documentation and submission.</p><ul><li>Document review</li><li>Application submission</li><li>Tracking updates</li><li>Fast processing</li></ul>', '<p>Hassle-free visa processing for Saudi Arabia, UAE, Turkey, and more. We handle all documentation and submission.</p><ul><li>Document review</li><li>Application submission</li><li>Tracking updates</li><li>Fast processing</li></ul>', '<p>د سعودي عربستان، متحده عربي اماراتو، ترکیې او نورو هیوادونو لپاره د ویزې بې دغدغې پروسه. موږ ټول اسناد او سپارنه ترسره کوو.</p><p>زموږ خدمتونه: د ویزې مشوره، د فورمو بشپړول، د اسنادو ژباړه، د ویزې ترلاسه کولو پورې تعقیب.</p>', '<p>پروسه صدور ویزا بدون دغدغه برای عربستان سعودی، امارات، ترکیه و سایر کشورها. ما تمام مدارک و مراحل ارسال را انجام می‌دهیم.</p><p>خدمات ما: مشاوره ویزا، تکمیل فرم‌ها، ترجمه مدارک، پیگیری تا دریافت ویزا.</p>', NULL, 299.00, 1, 1, 'visa', 'Multiple', 'Multiple', 'څوگوني', 'چندگانه', 0, 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29'),
(5, 'Istanbul Cultural Tour', 'Istanbul Cultural Tour', 'د استانبول کلتوري سفر', 'تور فرهنگی استانبول', 'istanbul-cultural-tour', '<h3>Discover the Crossroads of Civilizations</h3><p>Explore Istanbul\'s rich history with guided tours of Hagia Sophia, Blue Mosque, Topkapi Palace, and the Grand Bazaar.</p><ul><li>Return flights</li><li>4-star hotel</li><li>Professional guide</li><li>Entrance fees</li><li>Daily breakfast</li></ul>', '<h3>Discover the Crossroads of Civilizations</h3><p>Explore Istanbul\'s rich history with guided tours of Hagia Sophia, Blue Mosque, Topkapi Palace, and the Grand Bazaar.</p><ul><li>Return flights</li><li>4-star hotel</li><li>Professional guide</li><li>Entrance fees</li><li>Daily breakfast</li></ul>', '<h3>د تمدنونو تقاطع کشف کړئ</h3><p>د لارښود سفرونو سره د ایاصوفیه، نیلي جومات، توپکاپی ماڼۍ او د استانبول لوی بازار څخه لیدنه وکړئ. په داسې ښار کې یو هیریدونکی تجربه چې دوه براعظمونه سره نښلوي.</p>', '<h3>تقاطع تمدن‌ها را کشف کنید</h3><p>با تورهای راهنما از ایا صوفیه، مسجد آبی، کاخ توپکاپی و بازار بزرگ استانبول دیدن کنید. تجربه‌ای فراموش‌نشدنی در شهری که دو قاره را به هم متصل می‌کند.</p>', NULL, 1599.00, 6, 12, 'tour', 'Turkey', 'Turkey', 'ترکیه', 'ترکیه', 0, 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `page_sections`
--

CREATE TABLE `page_sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `page` varchar(60) NOT NULL DEFAULT 'home',
  `section_key` varchar(60) NOT NULL,
  `label` varchar(200) NOT NULL DEFAULT '',
  `label_en` varchar(200) NOT NULL DEFAULT '',
  `label_ps` varchar(200) NOT NULL DEFAULT '',
  `label_fa` varchar(200) NOT NULL DEFAULT '',
  `type` varchar(60) NOT NULL DEFAULT 'builtin' COMMENT 'builtin or custom_html',
  `content` longtext DEFAULT NULL COMMENT 'HTML content for custom sections',
  `content_en` longtext DEFAULT NULL,
  `content_ps` longtext DEFAULT NULL,
  `content_fa` longtext DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_sections`
--

INSERT INTO `page_sections` (`id`, `page`, `section_key`, `label`, `label_en`, `label_ps`, `label_fa`, `type`, `content`, `content_en`, `content_ps`, `content_fa`, `sort_order`, `active`, `created_at`) VALUES
(1, 'home', 'hero', 'Hero Banner', 'Hero Banner', '', '', 'builtin', '', '', NULL, NULL, 0, 1, '2026-06-30 07:58:37'),
(2, 'home', 'services', 'Services', 'Services', '', '', 'builtin', '', '', NULL, NULL, 1, 1, '2026-06-30 07:58:37'),
(3, 'home', 'destinations', 'Destinations', 'Destinations', '', '', 'builtin', '', '', NULL, NULL, 2, 1, '2026-06-30 07:58:37'),
(4, 'home', 'awards', 'Awards & Recognition', 'Awards & Recognition', '', '', 'builtin', '', '', NULL, NULL, 3, 1, '2026-06-30 07:58:37'),
(5, 'home', 'testimonials', 'Testimonials', 'Testimonials', '', '', 'builtin', '', '', NULL, NULL, 4, 1, '2026-06-30 07:58:37'),
(6, 'home', 'contact', 'Contact Form', 'Contact Form', '', '', 'builtin', '', '', NULL, NULL, 5, 1, '2026-06-30 07:58:37'),
(7, 'home', 'packages', 'Featured Packages', 'Featured Packages', '', '', 'builtin', '', '', NULL, NULL, 2, 1, '2026-06-30 08:13:06'),
(8, 'home', 'blog', 'Recent Blog Posts', 'Recent Blog Posts', '', '', 'builtin', '', '', NULL, NULL, 5, 1, '2026-06-30 08:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `title_en` varchar(200) NOT NULL DEFAULT '',
  `title_ps` varchar(200) NOT NULL DEFAULT '',
  `title_fa` varchar(200) NOT NULL DEFAULT '',
  `slug` varchar(200) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `excerpt_en` text DEFAULT NULL,
  `excerpt_ps` text DEFAULT NULL,
  `excerpt_fa` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `content_en` longtext DEFAULT NULL,
  `content_ps` longtext DEFAULT NULL,
  `content_fa` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `author` varchar(120) DEFAULT NULL,
  `author_en` varchar(120) NOT NULL DEFAULT '',
  `author_ps` varchar(120) NOT NULL DEFAULT '',
  `author_fa` varchar(120) NOT NULL DEFAULT '',
  `category` varchar(60) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `published_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `title_en`, `title_ps`, `title_fa`, `slug`, `excerpt`, `excerpt_en`, `excerpt_ps`, `excerpt_fa`, `content`, `content_en`, `content_ps`, `content_fa`, `image`, `author`, `author_en`, `author_ps`, `author_fa`, `category`, `featured`, `published_at`, `active`, `created_at`, `updated_at`) VALUES
(1, 'A Complete Guide to Performing Umrah', 'A Complete Guide to Performing Umrah', 'د عمرې د ترسره کولو بشپړ لارښود', 'راهنمای کامل انجام عمره', 'a-complete-guide-to-performing-umrah', 'Everything you need to know about your Umrah journey — from visa requirements to step-by-step rituals.', 'Everything you need to know about your Umrah journey — from visa requirements to step-by-step rituals.', 'د عمرې سفر په اړه هرڅه چې تاسو ورته اړتیا لرئ — د ویزې اړتیاوو څخه نیولې تر ګام په ګام مناسکو پورې.', 'هر آنچه باید درباره سفر عمره خود بدانید — از الزامات ویزا تا مناسک گام به گام.', '<h3>Introduction</h3>\r\n<p>Performing Umrah is a deeply spiritual experience that every Muslim aspires to undertake. This guide covers everything from preparation to completion.</p>\r\n<h3>Step 1: Visa Requirements</h3>\r\n<p>Ensure your passport is valid for at least 6 months. Contact Al Moqadas to process your Umrah visa quickly and hassle-free.</p>\r\n<h3>Step 2: Booking Your Package</h3>\r\n<p>Choose from our range of Umrah packages tailored to every budget. We handle flights, hotels, and transport so you can focus on worship.</p>\r\n<h3>Step 3: Ihram</h3>\r\n<p>Put on Ihram before entering the Miqat. Men wear two white seamless cloths; women wear modest clothing.</p>\r\n<h3>Step 4: Tawaf</h3>\r\n<p>Circumambulate the Kaaba seven times counterclockwise, reciting prayers and supplications.</p>\r\n<h3>Step 5: Sa\'i</h3>\r\n<p>Walk seven times between Safa and Marwa, commemorating Hajar\'s search for water.</p>\r\n<h3>Step 6: Shaving/Trimming Hair</h3>\r\n<p>Men shave their heads or trim; women cut a fingertip length of hair.</p>\r\n<h3>Conclusion</h3>\r\n<p>May your Umrah be accepted. Al Moqadas Travel is honored to serve you on this blessed journey.</p>', '<h3>Introduction</h3>\r\n<p>Performing Umrah is a deeply spiritual experience that every Muslim aspires to undertake. This guide covers everything from preparation to completion.</p>\r\n<h3>Step 1: Visa Requirements</h3>\r\n<p>Ensure your passport is valid for at least 6 months. Contact Al Moqadas to process your Umrah visa quickly and hassle-free.</p>\r\n<h3>Step 2: Booking Your Package</h3>\r\n<p>Choose from our range of Umrah packages tailored to every budget. We handle flights, hotels, and transport so you can focus on worship.</p>\r\n<h3>Step 3: Ihram</h3>\r\n<p>Put on Ihram before entering the Miqat. Men wear two white seamless cloths; women wear modest clothing.</p>\r\n<h3>Step 4: Tawaf</h3>\r\n<p>Circumambulate the Kaaba seven times counterclockwise, reciting prayers and supplications.</p>\r\n<h3>Step 5: Sa\'i</h3>\r\n<p>Walk seven times between Safa and Marwa, commemorating Hajar\'s search for water.</p>\r\n<h3>Step 6: Shaving/Trimming Hair</h3>\r\n<p>Men shave their heads or trim; women cut a fingertip length of hair.</p>\r\n<h3>Conclusion</h3>\r\n<p>May your Umrah be accepted. Al Moqadas Travel is honored to serve you on this blessed journey.</p>', '<h3>پیژندنه</h3><p>د عمرې ترسره کول یوه ژوره معنوي تجربه ده چې هر مسلمان یې د ترسره کولو هيله لري. دا لارښود تاسو په هر مرحله کې لارښوونه کوي.</p><h3>۱ مرحله: ویزه ترلاسه کول</h3><p>د عمرې ویزې لپاره تاسو ته معتبر پاسپورت (لږ تر لږه ۶ میاشتې اعتبار)، د پاسپورت عکسونه او بشپړ شوی فورمه درته اړینه ده. موږ په هر مرحله کې مرسته کوو.</p><h3>۲ مرحله: د بسته بک کول</h3><p>د خپل اړتیا سره سم مناسب بسته غوره کړئ. زموږ بستې هوټل، ترانسپورت او خواړه شاملوي.</p><h3>۳ مرحله: سفر</h3><p>سعودي عربستان ته د رسیدو له شیبې څخه، زموږ ټیم تاسو ته ښه راغلاست وايي او هوټل ته درسره ملګرتیا کوي.</p>', '<h3>مقدمه</h3><p>انجام عمره یک تجربه عمیق معنوی است که هر مسلمان آرزوی انجام آن را دارد. این راهنما شما را در هر مرحله راهنمایی می‌کند.</p><h3>مرحله ۱: دریافت ویزا</h3><p>برای ویزای عمره به پاسپورت معتبر (حداقل ۶ ماه اعتبار)، عکس پاسپورتی و فرم تکمیل شده نیاز دارید. ما در تمام مراحل کمک می‌کنیم.</p><h3>مرحله ۲: رزرو بسته</h3><p>با توجه به نیاز خود بسته مناسب را انتخاب کنید. بسته‌های ما شامل هتل، حمل و نقل، و غذا می‌باشند.</p><h3>مرحله ۳: سفر</h3><p>از لحظه رسیدن به عربستان، تیم ما از شما استقبال کرده و شما را تا هتل همراهی می‌کند.</p>', 'image_cbe072cd8a0a0e27.png', 'Al Moqadas Team', 'Al Moqadas Team', 'د المققدس ټیم', 'تیم المققدس', 'guide', 1, '2026-05-27 03:43:00', 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29'),
(2, 'Top 10 Travel Destinations for Muslim Travelers in 2026', 'Top 10 Travel Destinations for Muslim Travelers in 2026', 'په ۲۰۲۶ کال کې د مسلمانو مسافرانو لپاره ۱۰ غوره سفر ځایونه', '۱۰ مقصد برتر سفر برای مسافران مسلمان در سال ۲۰۲۶', 'top-10-travel-destinations-for-muslim-travelers-in-2026', 'Discover the best halal-friendly destinations around the world for your next vacation.', 'Discover the best halal-friendly destinations around the world for your next vacation.', 'د خپل راتلونکي رخصتۍ لپاره د نړۍ په کچه د حلال دوستانه غوره ځایونه ومومئ.', 'بهترین مقصدهای حلال‌پسند در سراسر جهان برای تعطیلات بعدی خود را کشف کنید.', '<h3>1. Saudi Arabia</h3><p>The heart of the Islamic world, home to Makkah and Madinah. Also explore the Red Sea coast and modern Riyadh.</p><h3>2. Turkey</h3><p>Istanbul, Cappadocia, and the Turkish Riviera offer amazing halal-friendly experiences with rich Islamic history.</p><h3>3. Malaysia</h3><p>Halal food paradise with stunning beaches, rainforests, and modern cities like Kuala Lumpur.</p><h3>4. UAE</h3><p>Dubai and Abu Dhabi offer luxury travel with excellent halal dining and family-friendly attractions.</p><h3>5. Maldives</h3><p>Private resort islands with halal food and prayer facilities — the perfect romantic getaway.</p><h3>6. Morocco</h3><p>Rich Islamic heritage, vibrant souks, and beautiful architecture in Marrakech and Fes.</p><h3>7. Indonesia</h3><p>The world\'s largest Muslim population — Bali, Jakarta, and Yogyakarta with incredible cultural experiences.</p><h3>8. Uzbekistan</h3><p>Ancient Silk Road cities like Samarkand and Bukhara with stunning Islamic architecture.</p><h3>9. Jordan</h3><p>Petra, the Dead Sea, and Amman — safe and welcoming for Muslim travelers.</p><h3>10. Qatar</h3><p>World-class museums, shopping, and culture in Doha with excellent halal options.</p>', '<h3>1. Saudi Arabia</h3><p>The heart of the Islamic world, home to Makkah and Madinah. Also explore the Red Sea coast and modern Riyadh.</p><h3>2. Turkey</h3><p>Istanbul, Cappadocia, and the Turkish Riviera offer amazing halal-friendly experiences with rich Islamic history.</p><h3>3. Malaysia</h3><p>Halal food paradise with stunning beaches, rainforests, and modern cities like Kuala Lumpur.</p><h3>4. UAE</h3><p>Dubai and Abu Dhabi offer luxury travel with excellent halal dining and family-friendly attractions.</p><h3>5. Maldives</h3><p>Private resort islands with halal food and prayer facilities — the perfect romantic getaway.</p><h3>6. Morocco</h3><p>Rich Islamic heritage, vibrant souks, and beautiful architecture in Marrakech and Fes.</p><h3>7. Indonesia</h3><p>The world\'s largest Muslim population — Bali, Jakarta, and Yogyakarta with incredible cultural experiences.</p><h3>8. Uzbekistan</h3><p>Ancient Silk Road cities like Samarkand and Bukhara with stunning Islamic architecture.</p><h3>9. Jordan</h3><p>Petra, the Dead Sea, and Amman — safe and welcoming for Muslim travelers.</p><h3>10. Qatar</h3><p>World-class museums, shopping, and culture in Doha with excellent halal options.</p>', '<h3>۱. سعودي عربستان</h3><p>د اسلامي نړۍ زړه، د مکې او مدینې کور. همدارنګه د سره سمندر غاړې او د ریاض او جدې مدرن جاذبې وګورئ.</p><h3>۲. ترکیه</h3><p>د تاریخ، کلتور او حلال خوړو ترکیب. استانبول، انټالیا او کاپادوکیا مشهور ځایونه دي.</p><h3>۳. مالیزیا</h3><p>کوالالامپور د حلال خوړو او ښکلي جوماتونو سره د کورنیو لپاره یو غوره ځای دی.</p><h3>۴. متحده عربي امارات</h3><p>دوبۍ او ابوظبي د مدرن اسانتیاوو، پیرود او حلال دوستانه تفریحاتو سره.</p>', '<h3>۱. عربستان سعودی</h3><p>قلب جهان اسلام، خانه مکه و مدینه. همچنین از سواحل دریای سرخ و جاذبه‌های مدرن ریاض و جده دیدن کنید.</p><h3>۲. ترکیه</h3><p>ترکیبی از تاریخ، فرهنگ و غذاهای حلال. استانبول، آنتالیا و کاپادوکیا از مقاصد محبوب هستند.</p><h3>۳. مالزی</h3><p>کوالالامپور با غذاهای حلال و مساجد زیبا، مقصدی عالی برای خانواده‌ها است.</p><h3>۴. امارات متحده عربی</h3><p>دبی و ابوظبی با امکانات مدرن، خرید و تفریحات حلال‌پسند.</p>', NULL, 'Travel Desk', 'Travel Desk', 'د سفر څانګه', 'بخش مسافرت', 'travel', 0, '2026-05-11 03:43:21', 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29'),
(3, 'How to Prepare for Your First Hajj Pilgrimage', 'How to Prepare for Your First Hajj Pilgrimage', 'د لومړي حج لپاره څنګه چمتو شو', 'چگونه برای اولین حج خود آماده شویم', 'how-to-prepare-for-your-first-hajj-pilgrimage', 'A practical checklist to help first-time pilgrims prepare physically, mentally, and spiritually.', 'A practical checklist to help first-time pilgrims prepare physically, mentally, and spiritually.', 'د لومړي ځل زائرانو لپاره یو عملي چک لیست د فزیکي، روحی او معنوي چمتووالي لپاره.', 'یک چک‌لیست عملی برای کمک به زائران بار اول جهت آمادگی جسمی، روحی و معنوی.', '<h3>Spiritual Preparation</h3><p>Begin by learning about the rituals of Hajj. Read books, attend seminars, and make sincere intention (niyyah). Increase your daily prayers and charity.</p><h3>Physical Preparation</h3><p>Start walking daily to build endurance. You will walk long distances in Mina, Arafat, and Muzdalifah. Stay hydrated and eat healthy.</p><h3>Packing Checklist</h3><ul><li>Ihram clothing (two pieces for men)</li><li>Comfortable sandals</li><li>Medications and first aid kit</li><li>Sunscreen and umbrella</li><li>Small backpack</li><li>Water bottle</li><li>Prayer mat</li><li>Quran and dua book</li></ul><h3>Practical Tips</h3><p>Label your belongings. Keep copies of your passport and visa. Stay with your group. Use the Al Moqadas app for updates. Conserve energy for the important days.</p>', '<h3>Spiritual Preparation</h3><p>Begin by learning about the rituals of Hajj. Read books, attend seminars, and make sincere intention (niyyah). Increase your daily prayers and charity.</p><h3>Physical Preparation</h3><p>Start walking daily to build endurance. You will walk long distances in Mina, Arafat, and Muzdalifah. Stay hydrated and eat healthy.</p><h3>Packing Checklist</h3><ul><li>Ihram clothing (two pieces for men)</li><li>Comfortable sandals</li><li>Medications and first aid kit</li><li>Sunscreen and umbrella</li><li>Small backpack</li><li>Water bottle</li><li>Prayer mat</li><li>Quran and dua book</li></ul><h3>Practical Tips</h3><p>Label your belongings. Keep copies of your passport and visa. Stay with your group. Use the Al Moqadas app for updates. Conserve energy for the important days.</p>', '<h3>روحي چمتوالی</h3><p>د حج د مناسکو په زده کړې سره پیل وکړئ. کتابونه ولولئ، سیمینارونو کې برخه واخلئ او اخلاص دعاګانې وکړئ.</p><h3>فزیکي چمتوالی</h3><p>حج ډیر پیدل ته اړتیا لري. څو میاشتې مخکې تمرین پیل کړئ او ورځنی پیدل مه هیروئ.</p><h3>اړین اسناد</h3><p>معتبر پاسپورت، ویزه، واکسیناسیون او د پاسپورت عکسونه اړین اسناد دي.</p>', '<h3>آمادگی معنوی</h3><p>با یادگیری مناسک حج شروع کنید. کتاب بخوانید، در سمینارها شرکت کنید و دعاهای خالصانه داشته باشید.</p><h3>آمادگی جسمی</h3><p>حج نیاز به پیاده‌روی زیاد دارد. از ماه‌ها قبل ورزش کنید و پیاده‌روی روزانه را فراموش نکنید.</p><h3>مدارک مورد نیاز</h3><p>پاسپورت معتبر، ویزا، واکسیناسیون، و عکس پاسپورتی از مدارک ضروری هستند.</p>', NULL, 'Hajj Department', 'Hajj Department', 'د حج څانګه', 'اداره حج', 'hajj', 0, '2026-06-14 03:43:21', 1, '2026-06-30 08:13:21', '2026-07-05 06:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(120) NOT NULL,
  `title_en` varchar(120) NOT NULL DEFAULT '',
  `title_ps` varchar(120) NOT NULL DEFAULT '',
  `title_fa` varchar(120) NOT NULL DEFAULT '',
  `tag` varchar(60) NOT NULL DEFAULT '',
  `tag_en` varchar(60) NOT NULL DEFAULT '',
  `tag_ps` varchar(60) NOT NULL DEFAULT '',
  `tag_fa` varchar(60) NOT NULL DEFAULT '',
  `description` text NOT NULL DEFAULT '',
  `description_en` text DEFAULT NULL,
  `description_ps` text DEFAULT NULL,
  `description_fa` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `title_en`, `title_ps`, `title_fa`, `tag`, `tag_en`, `tag_ps`, `tag_fa`, `description`, `description_en`, `description_ps`, `description_fa`, `image`, `link`, `sort_order`, `active`, `created_at`) VALUES
(1, 'Umrah Packages', 'Umrah Packages', 'د عمرې بستې', 'بسته‌های عمره', 'UMRAH', 'UMRAH', 'عمره', 'عمره', 'Affordable and luxury Umrah packages with hotel, transport, and guided tours &mdash; all included for a blessed journey.', 'Affordable and luxury Umrah packages with hotel, transport, and guided tours &mdash; all included for a blessed journey.', 'ارزانه او لوکس د عمرې بستې د هوټل، ترانسپورت او لارښود سفرونو سره — ټول د یو برکتناک سفر لپاره شامل دي.', 'بسته‌های عمره مقرون به صرفه و لوکس با هتل، حمل و نقل و تورهای راهنما — همه شامل برای یک سفر پربرکت.', 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=1600&q=80', '/contact', 0, 1, '2026-07-01 10:17:11'),
(2, 'Hajj Packages', 'Hajj Packages', 'د حج بستې', 'بسته‌های حج', 'HAJJ', 'HAJJ', 'حج', 'حج', 'Comprehensive Hajj arrangements with experienced guides, premium hotels close to Haram, and full support throughout.', 'Comprehensive Hajj arrangements with experienced guides, premium hotels close to Haram, and full support throughout.', 'جامع د حج ترتیبات د تجربه لرونکو لارښودانو، د حرم سره نږدې عالي هوټلونو او د سفر په اوږدو کې بشپړ ملاتړ سره.', 'ترتیبات جامع حج با راهنمایان مجرب، هتل‌های ممتاز نزدیک حرم و پشتیبانی کامل در طول سفر.', 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=1600&q=80', '/contact', 1, 1, '2026-07-01 10:17:11'),
(3, 'Flight Booking', 'Flight Booking', 'د الوتنې بکینګ', 'رزرو بلیط هواپیما', 'FLIGHTS', 'FLIGHTS', 'الوتنې', 'پروازها', 'Best fares on domestic and international flights with our airline partnerships including Kam Air and major carriers.', 'Best fares on domestic and international flights with our airline partnerships including Kam Air and major carriers.', 'د کام ایر او نورو لویو شرکتونو سره د کورنیو او نړیوالو الوتنو لپاره غوري نرخونه.', 'بهترین قیمت‌ها برای پروازهای داخلی و بین‌المللی با مشارکت کام ایر و سایر شرکت‌های هواپیمایی معتبر.', 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&q=80', '/contact', 2, 1, '2026-07-01 10:17:11'),
(4, 'Visa Services', 'Visa Services', 'د ویزې خدمتونه', 'خدمات ویزا', 'VISA', 'VISA', 'ویزه', 'ویزا', 'Hassle-free visa processing for multiple destinations with expert documentation support and fast turnaround.', 'Hassle-free visa processing for multiple destinations with expert documentation support and fast turnaround.', 'د څو ځایونو لپاره بې دغدغې د ویزې پروسس د متخصص اسنادو ملاتړ او چټک اجرا سره.', 'پروسه صدور ویزا بدون دغدغه برای مقاصد متعدد با پشتیبانی متخصص در اسناد و تحویل سریع.', 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1600&q=80', '/contact', 3, 1, '2026-07-01 10:17:11'),
(5, 'Hotel Reservations', 'Hotel Reservations', 'د هوټل بکینګ', 'رزرو هتل', 'HOTELS', 'HOTELS', 'هوټلونه', 'هتل‌ها', 'Curated hotel bookings from budget-friendly to luxury stays, carefully selected for comfort and proximity.', 'Curated hotel bookings from budget-friendly to luxury stays, carefully selected for comfort and proximity.', 'غوره شوي هوټل بکینګ له ارزانه څخه تر لوکس پورې، د آرامتیا او نږدېوالي لپاره په دقت سره غوره شوي.', 'رزرو هتل‌های برگزیده از اقتصادی تا لوکس، با دقت انتخاب شده برای راحتی و نزدیکی به اماکن مقدس.', 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80', '/contact', 4, 1, '2026-07-01 10:17:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `key` varchar(100) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'text' COMMENT 'text, textarea, color, image, number, boolean'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key`, `value`, `type`) VALUES
('about_cta_btn_text', 'Contact Us Today', 'text'),
('about_cta_btn_text_fa', 'امروز با ما تماس بگیرید', 'text'),
('about_cta_btn_text_ps', 'نن موږ سره اړیکه ونیسئ', 'text'),
('about_cta_btn_url', '/new/contact', 'text'),
('about_cta_text', 'Let our team guide you through every step — from visa to worship at the Haram.', 'text'),
('about_cta_text_fa', 'بگذارید تیم ما شما را در هر مرحله راهنمایی کند — از ویزا تا عبادت در حرم.', 'text'),
('about_cta_text_ps', 'زموږ ټیم دې تاسو په هر مرحله کې لارښوونه وکړي — د ویزې څخه تر حرم کې عبادت پورې.', 'text'),
('about_cta_title', 'Ready To Begin Your Journey?', 'text'),
('about_cta_title_fa', 'آماده شروع سفر خود هستید؟', 'text'),
('about_cta_title_ps', 'د خپل سفر پیل لپاره چمتو یاست؟', 'text'),
('about_hero_badge', 'Our Story Since 2010', 'text'),
('about_hero_badge_fa', 'داستان ما از سال ۲۰۱۰', 'text'),
('about_hero_badge_ps', 'زموږ کیسه د ۲۰۱۰ کال راهیسې', 'text'),
('about_hero_subtitle', 'For over two decades, Al Ekhlas has walked beside thousands of pilgrims and travelers — turning every journey into an experience of faith, comfort, and trust.', 'text'),
('about_hero_subtitle_fa', 'برای بیش از دو دهه، المققدس در کنار هزاران زائر و مسافر بوده است — تبدیل هر سفر به تجربه‌ای از ایمان، آسایش و اعتماد.', 'text'),
('about_hero_subtitle_ps', 'د دوه لسیزو څخه د زیاتې مودې لپاره، المققدس د زرګونو زائرانو او مسافرانو تر څنګ ولاړ دی — هر سفر د ایمان، آرامتیا او باور تجربه ګرځوي.', 'text'),
('about_hero_title', 'Guiding Hearts To<br><span class=\"orange\">Sacred Places</span>', 'text'),
('about_hero_title_fa', 'راهنمایی قلب‌ها به<br><span class=\"orange\">سوی اماکن مقدس</span>', 'text'),
('about_hero_title_ps', 'زړونه د<span class=\"orange\">مقدسو ځایونو</span> لور ته لارښوونه', 'text'),
('about_intro_badge', '20+ Years of Trust', 'text'),
('about_intro_badge_fa', 'بیش از ۲۰ سال اعتماد', 'text'),
('about_intro_badge_ps', 'له ۲۰ کلونو څخه زیات باور', 'text'),
('about_intro_image', 'about_intro_image_2a0cf75797671224.png', 'text'),
('about_intro_tag', 'Who We Are', 'text'),
('about_intro_tag_fa', 'ما که هستیم', 'text'),
('about_intro_tag_ps', 'موږ څوک یو', 'text'),
('about_intro_text', 'Al Ekhlas Travel Agency was founded in Kabul with a single purpose: to make the sacred journeys of Hajj and Umrah accessible, comfortable, and worry-free for every Afghan family.\r\n\r\nWhat began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house — handling flights, visas, hotels, and tours across more than 30 destinations worldwide.\r\n\r\nThrough every chapter, our promise has stayed the same: treat every traveler like family, and handle every detail like it\'s our own pilgrimage.', 'text'),
('about_intro_text_fa', 'آژانس مسافرتی المققدس در کابل با یک هدف تأسیس شد: دسترسی به سفرهای مقدس حج و عمره را برای هر خانواده افغان آسان، راحت و بدون دغدغه کند.\n\nآنچه به عنوان یک دفتر کوچک شروع شد که به همسایگان در رزرو اولین سفر زیارتی کمک می‌کرد، به یک آژانس مسافرتی تمام‌خدمت تبدیل شده است — مدیریت پروازها، ویزاها، هتل‌ها و تورها در بیش از ۳۰ مقصد در سراسر جهان.\n\nدر هر مرحله، قول ما ثابت مانده است: با هر مسافر مانند خانواده رفتار کنیم و هر جزئیات را مانند سفر خودمان مدیریت کنیم.', 'text'),
('about_intro_text_ps', 'المققدس د سفر اژانس په کابل کې د یو هدف سره تاسیس شو: د هر افغان کورنۍ لپاره د حج او عمرې مقدس سفرونه د لاسرسي وړ، آرام او بې دغدغې کول.\n\nهغه څه چې د یو کوچني دفتر په توګه پیل شول چې ګاونډیانو ته یې د لومړي زیارت سفر بک کولو کې مرسته کوله، یو بشپړ خدمتي سفر اژانس شو — د ۳۰ څخه د زیاتو نړیوالو ځایونو لپاره د الوتنو، ویزو، هوټلونو او سفرونو مدیریت.\n\nپه هر فصل کې، زموږ ژمنه یو شان ده: له هر مسافر سره د کورنۍ په څیر چلند وکړو، او هر جزییات د خپل سفر په څیر مدیریت کړو.', 'text'),
('about_intro_title', 'A Journey Built On Faith & Service', 'text'),
('about_intro_title_fa', 'سفری ساخته شده بر ایمان و خدمت', 'text'),
('about_intro_title_ps', 'د ایمان او خدمت پر بنسټ جوړ شوی سفر', 'text'),
('about_meta_description', 'Learn about our story since 2010, our mission, vision, values, and the team behind Al Moqadas.', 'text'),
('about_meta_title', 'About Us — Al Ekhlas Travel Agency', 'text'),
('about_mission_text', 'To deliver safe, affordable, and spiritually fulfilling travel experiences — especially Hajj and Umrah — with honesty and care at every step.', 'text'),
('about_mission_text_fa', 'ارائه تجربه‌های سفری امن، مقرون به صرفه و از نظر معنوی رضایت‌بخش — به ویژه حج و عمره — با صداقت و مراقبت در هر مرحله.', 'text'),
('about_mission_text_ps', 'خوندي، ارزانه او روحاني پلوه رضایت بخښونکي د سفر تجربې وړاندې کول — په ځانګړې توګه حج او عمره — په هر مرحله کې له اخلاص او پاملرنې سره.', 'text'),
('about_mission_title', 'Our Mission', 'text'),
('about_mission_title_fa', 'ماموریت ما', 'text'),
('about_mission_title_ps', 'زموږ موخه', 'text'),
('about_section_desc', 'The principles that guide every package we plan and every traveler we serve.', 'text'),
('about_section_desc_fa', 'اصولی که هر بسته را برنامه‌ریزی می‌کنیم و هر مسافری را خدمت می‌کنیم.', 'text'),
('about_section_desc_ps', 'هغه اصول چې موږ هر بسته پلان جوړوو او هر مسافر ته خدمت کوو.', 'text'),
('about_section_tag', 'What Drives Us', 'text'),
('about_section_tag_fa', 'آنچه ما را حرکت می‌دهد', 'text'),
('about_section_tag_ps', 'هغه څه چې موږ حرکت کوي', 'text'),
('about_section_title', 'Mission, Vision & Values', 'text'),
('about_section_title_fa', 'ماموریت، چشم‌انداز و ارزش‌ها', 'text'),
('about_section_title_ps', 'موخه، لید او ارزښتونه', 'text'),
('about_stat1_label', 'Years Experience', 'text'),
('about_stat1_num', '20+', 'text'),
('about_stat2_label', 'Happy Pilgrims', 'text'),
('about_stat2_num', '50K+', 'text'),
('about_stat3_label', 'Destinations', 'text'),
('about_stat3_num', '30+', 'text'),
('about_stat4_label', 'Visa Success', 'text'),
('about_stat4_num', '100%', 'text'),
('about_team_count', '3', 'text'),
('about_team_desc', 'A dedicated team of travel consultants, visa specialists, and pilgrimage guides.', 'text'),
('about_team_desc_fa', 'تیمی متشکل از مشاوران مسافرتی، متخصصان ویزا و راهنمایان زیارتی.', 'text'),
('about_team_desc_ps', 'د سفر مشاورینو، د ویزې متخصصینو او زیارت لارښودانو وقف شوی ټیم.', 'text'),
('about_team_lead_bio', 'With over 20 years in the travel industry, Mohammad founded Al Moqadas with a single purpose: to serve his community. What began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house trusted by thousands.', 'text'),
('about_team_lead_initials', 'MA', 'text'),
('about_team_lead_name', 'Mohammad Aref', 'text'),
('about_team_lead_role', 'Founder & CEO', 'text'),
('about_team_tag', 'Meet The Team', 'text'),
('about_team_tag_fa', 'آشنایی با تیم', 'text'),
('about_team_tag_ps', 'له ټیم سره آشنایی', 'text'),
('about_team_title', 'The People Behind Your Journey', 'text'),
('about_team_title_fa', 'افراد پشت سفر شما', 'text'),
('about_team_title_ps', 'ستاسو د سفر تر شا خلک', 'text'),
('about_team1_initials', 'NS', 'text'),
('about_team1_name', 'Najibullah Sadat', 'text'),
('about_team1_role', 'Operations Director', 'text'),
('about_team2_initials', 'ZA', 'text'),
('about_team2_name', 'Zahra Ahmadi', 'text'),
('about_team2_role', 'Visa & Documentation Lead', 'text'),
('about_team3_initials', 'KY', 'text'),
('about_team3_name', 'Karim Yousafi', 'text'),
('about_team3_role', 'Senior Travel Consultant', 'text'),
('about_timeline_count', '5', 'text'),
('about_timeline_desc', 'Two decades of growth, trust, and service to our community.', 'text'),
('about_timeline_desc_fa', 'دو دهه رشد، اعتماد و خدمت به جامعه ما.', 'text'),
('about_timeline_desc_ps', 'دوه لسیزې وده، باور او زموږ ټولنې ته خدمت.', 'text'),
('about_timeline_tag', 'Our Journey', 'text'),
('about_timeline_tag_fa', 'مسیر ما', 'text'),
('about_timeline_tag_ps', 'زموږ لاره', 'text'),
('about_timeline_title', 'Milestones Along The Way', 'text'),
('about_timeline_title_fa', 'نقاط عطف در طول مسیر', 'text'),
('about_timeline_title_ps', 'د لارې په اوږدو کې مهم ټکي', 'text'),
('about_timeline1_text', 'Al Moqadas opens its doors, offering Umrah packages and flight bookings to the local community.', 'text'),
('about_timeline1_title', 'Founded in Kabul', 'text'),
('about_timeline1_year', '2010', 'text'),
('about_timeline2_text', 'Expanded into full Hajj packages, partnering with trusted hotels near the Haram in Mecca and Medina.', 'text'),
('about_timeline2_title', 'Hajj Operations Begin', 'text'),
('about_timeline2_year', '2015', 'text'),
('about_timeline3_text', 'Recognized by Kam Air for outstanding ticket sales performance and partnership reliability.', 'text'),
('about_timeline3_title', 'Kam Air Excellence Award', 'text'),
('about_timeline3_year', '2020', 'text'),
('about_timeline4_text', 'Added visa services and custom tours for Dubai, Istanbul, Malaysia, and Europe.', 'text'),
('about_timeline4_title', 'Regional Expansion', 'text'),
('about_timeline4_year', '2023', 'text'),
('about_timeline5_text', 'Today, Al Moqadas proudly serves families across Afghanistan with a 100% visa success record.', 'text'),
('about_timeline5_title', '50,000+ Pilgrims Served', 'text'),
('about_timeline5_year', '2026', 'text'),
('about_values_text', 'Integrity, compassion, and dedication — we treat every client\'s journey as if it were our own family\'s pilgrimage.', 'text'),
('about_values_text_fa', 'صداقت، دلسوزی و تعهد — ما سفر هر مشتری را مانند سفر خانواده خودمان می‌دانیم.', 'text'),
('about_values_text_ps', 'اخلاص، مهرباني او ژمنتیا — موږ د هر پیرودونکي سفر د خپلې کورنۍ د سفر په څیر ګڼو.', 'text'),
('about_values_title', 'Our Values', 'text'),
('about_values_title_fa', 'ارزش‌های ما', 'text'),
('about_values_title_ps', 'زموږ ارزښتونه', 'text'),
('about_vision_items', 'Reliability,Compassion,Excellence', 'text'),
('about_vision_text', 'To become the most trusted travel agency in Afghanistan and the region, known for reliability, compassion, and excellence in service.', 'text'),
('about_vision_text_fa', 'تبدیل شدن به معتمدترین آژانس مسافرتی در افغانستان و منطقه، معروف به قابلیت اعتماد، دلسوزی و تعالی در خدمت.', 'text'),
('about_vision_text_ps', 'په افغانستان او سیمه کې د باور وړ ترین د سفر اژانس کیدل، د اعتبار، مهربانۍ او خدمت کې د غوره والي لپاره مشهور.', 'text'),
('about_vision_title', 'Our Vision', 'text'),
('about_vision_title_fa', 'چشم‌انداز ما', 'text'),
('about_vision_title_ps', 'زموږ لید', 'text'),
('awards_badge_fa', 'تقدیر و اعتماد', 'text'),
('awards_badge_ps', 'ستاینه او باور', 'text'),
('awards_subtitle_fa', 'مورد تقدیر سازمان‌های پیشرو صنعت برای خدمات معتمد و تعالی ما.', 'text'),
('awards_subtitle_ps', 'د مخکښو صنعت سازمانونو لخوا زموږ د معتبر خدمت او غوره والي لپاره پیژندل شوي.', 'text'),
('awards_title_fa', 'افتخارات و <span class=\"orange\">دستاوردها</span>', 'text'),
('awards_title_ps', 'وياړونه او <span class=\"orange\">لاس ته راوړنې</span>', 'text'),
('color_bg', '#ffffff', 'text'),
('color_bg2', '#f4f6f9', 'text'),
('color_navy', '#0078d7', 'text'),
('color_navy_dark', '#005a9e', 'text'),
('color_navy_light', '#4aa9ff', 'text'),
('color_primary', '#a62020', 'text'),
('color_primary_dark', '#821919', 'text'),
('color_primary_light', '#d35b5b', 'text'),
('contact_address', 'Kabul, Afghanistan', 'text'),
('contact_email', 'info@yoursite.com', 'text'),
('contact_faq_desc', 'Quick answers to the most common inquiries we receive.', 'text'),
('contact_faq_tag', 'Common Questions', 'text'),
('contact_faq_title', 'Frequently Asked Questions', 'text'),
('contact_form_badge', 'Send Us a Message', 'text'),
('contact_form_heading', 'Request a Package', 'text'),
('contact_form_text', 'Tell us about your travel plans and we\'ll create a custom quote.', 'text'),
('contact_hero_badge', 'We\'re Here To Help', 'text'),
('contact_hero_subtitle', 'Whether you need a full Umrah package, a flight ticket, or just some advice — reach out and our team will respond within 24 hours.', 'text'),
('contact_hero_title', 'Let\'s Plan Your<br><span class=\"orange\">Next Journey</span>', 'text'),
('contact_hours_friday', 'Closed', 'text'),
('contact_hours_week', '8:00 AM – 6:00 PM', 'text'),
('contact_phone', '+93 700 000 000', 'text'),
('contact_sidebar_badge', 'Get In Touch', 'text'),
('contact_sidebar_heading', 'We\'d Love to Hear From You', 'text'),
('contact_sidebar_text', 'Our travel consultants are ready to help plan your perfect journey.', 'text'),
('favicon', 'favicon_8ab6b04d973d2b03.png', 'text'),
('footer_copyright', 'Al Ekhlas Travel Agency', 'text'),
('footer_copyright_fa', '© ۲۰۲۶ المققدس. تمام حقوق محفوظ است.', 'text'),
('footer_copyright_ps', '© ۲۰۲۶ المققدس. ټول حقونه خوندي دي.', 'text'),
('footer_description', 'Your trusted partner for Hajj, Umrah, and worldwide travel since 2010. Serving pilgrims and travelers with care, integrity, and excellence.', 'text'),
('footer_description_fa', 'آژانس مسافرتی المققدس — ارائه‌دهنده خدمات حج، عمره، ویزا، پرواز و تورهای گردشگری با بیش از ۲۰ سال تجربه.', 'text'),
('footer_description_ps', 'المققدس د سفر اژانس — د حج، عمرې، ویزې، الوتنې او سفرونو خدماتو وړاندې کوونکی د ۲۰ کلونو څخه د زیاتې تجربې سره.', 'text'),
('footer_destinations_heading', 'Destinations', 'text'),
('footer_destinations_heading_fa', 'مقاصد', 'text'),
('footer_destinations_heading_ps', 'ځایونه', 'text'),
('footer_services_heading', 'Services', 'text'),
('footer_services_heading_fa', 'خدمات', 'text'),
('footer_services_heading_ps', 'خدمتونه', 'text'),
('footer_tagline', 'Certified Hajj &amp; Umrah Operator', 'text'),
('footer_tagline_fa', 'دارنده مجوز رسمی حج و عمره', 'text'),
('footer_tagline_ps', 'د حج او عمرې رسمي جواز لرونکی', 'text'),
('google_analytics_id', '', 'text'),
('hero_badge', 'Trusted Since 2010 · Hajj & Umrah Specialists', 'text'),
('hero_badge_fa', 'معتمد از سال ۲۰۱۰ · متخصصان حج و عمره', 'text'),
('hero_badge_ps', 'د ۲۰۱۰ کال راهیسې معتبر · د حج او عمرې متخصصین', 'text'),
('hero_btn1_text', 'Explore Packages', 'text'),
('hero_btn1_text_fa', 'مشاهده بسته‌ها', 'text'),
('hero_btn1_text_ps', 'بستې وګورئ', 'text'),
('hero_btn1_url', '/new/services', 'text'),
('hero_btn2_text', 'View Destinations', 'text'),
('hero_btn2_text_fa', 'مشاهده مقاصد', 'text'),
('hero_btn2_text_ps', 'ځایونه وګورئ', 'text'),
('hero_btn2_url', '/new/destinations', 'text'),
('hero_kaaba_img', 'hero_kaaba_img_dc9121503efe4ed4.png', 'text'),
('hero_slide1_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400', 'text'),
('hero_slide1_label', 'Dubai', 'text'),
('hero_slide2_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400', 'text'),
('hero_slide2_label', 'Istanbul', 'text'),
('hero_slide3_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=400', 'text'),
('hero_slide3_label', 'Kabul', 'text'),
('hero_slide4_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=400', 'text'),
('hero_slide4_label', 'Kuala Lumpur', 'text'),
('hero_slide5_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/Al_Masjid_An-Nabawi.jpg?width=400', 'text'),
('hero_slide5_label', 'Medina', 'text'),
('hero_slide6_img', 'https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=400', 'text'),
('hero_slide6_label', 'London', 'text'),
('hero_stat1_label', 'Years Experience', 'text'),
('hero_stat1_label_fa', 'سال تجربه', 'text'),
('hero_stat1_label_ps', 'کاله تجربه', 'text'),
('hero_stat1_num', '20+', 'text'),
('hero_stat2_label', 'Happy Pilgrims', 'text'),
('hero_stat2_label_fa', 'زائران خوشحال', 'text'),
('hero_stat2_label_ps', 'خوشحاله زائران', 'text'),
('hero_stat2_num', '50K+', 'text'),
('hero_stat3_label', 'Destinations', 'text'),
('hero_stat3_label_fa', 'مقاصد', 'text'),
('hero_stat3_label_ps', 'ځایونه', 'text'),
('hero_stat3_num', '30+', 'text'),
('hero_stat4_label', 'Visa Success', 'text'),
('hero_stat4_label_fa', 'موفقیت ویزا', 'text'),
('hero_stat4_label_ps', 'د ویزې بریالیتوب', 'text'),
('hero_stat4_num', '100%', 'text'),
('hero_subtitle', 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.', 'text'),
('hero_subtitle_fa', 'بسته‌های ممتاز حج و عمره، پروازهای جهانی، خدمات ویزا و تجربه‌های سفری برگزیده متناسب با شما.', 'text'),
('hero_subtitle_ps', 'د حج او عمرې غوره بستې، نړیوالې الوتنې، د ویزې خدمتونه او ستاسو لپاره ډیزاین شوي د سفر انتخابي تجربې.', 'text'),
('hero_title', 'Your Sacred Journey<br><span class=\"orange\">Begins Here</span>', 'text'),
('hero_title_fa', 'سفر مقدس شما<br><span class=\"orange\">از اینجا آغاز می‌شود</span>', 'text'),
('hero_title_ps', 'ستاسو مقدس سفر<br><span class=\"orange\">دلته پیلېږي</span>', 'text'),
('logo_icon', 'fa-mosque', 'text'),
('logo_image', 'logo_image_2a6cbae46aad9328.png', 'text'),
('logo_text', 'Al Ekhlas', 'text'),
('logo_text_fa', 'المققدس', 'text'),
('logo_text_ps', 'المققدس', 'text'),
('meta_description', 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.', 'text'),
('meta_keywords', 'Hajj, Umrah, travel agency, flights, visa, Afghanistan', 'text'),
('site_name', 'Al Ekhlas Travel Agency', 'text'),
('site_name_fa', 'آژانس مسافرتی المققدس', 'text'),
('site_name_ps', 'المققدس د سفر اژانس', 'text'),
('site_tagline', 'Your Sacred Journey Begins Here', 'text'),
('site_tagline_fa', 'سفر مقدس شما از اینجا آغاز می‌شود', 'text'),
('site_tagline_ps', 'ستاسو مقدس سفر دلته پیلېږي', 'text'),
('social_facebook', '#', 'text'),
('social_instagram', '', 'text'),
('social_linkedin', '#', 'text'),
('social_twitter', '#', 'text'),
('whatsapp_number', '93700000000', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `name_en` varchar(120) NOT NULL DEFAULT '',
  `name_ps` varchar(120) NOT NULL DEFAULT '',
  `name_fa` varchar(120) NOT NULL DEFAULT '',
  `role` varchar(120) NOT NULL DEFAULT '',
  `role_en` varchar(120) NOT NULL DEFAULT '',
  `role_ps` varchar(120) NOT NULL DEFAULT '',
  `role_fa` varchar(120) NOT NULL DEFAULT '',
  `bio` text DEFAULT NULL,
  `bio_en` text DEFAULT NULL,
  `bio_ps` text DEFAULT NULL,
  `bio_fa` text DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `type` enum('lead','member') NOT NULL DEFAULT 'member',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `name_en`, `name_ps`, `name_fa`, `role`, `role_en`, `role_ps`, `role_fa`, `bio`, `bio_en`, `bio_ps`, `bio_fa`, `image`, `type`, `sort_order`, `active`, `created_at`) VALUES
(2, 'Matiullah', 'Matiullah', 'متیع الله', 'متیع‌الله', 'Operation Manager', 'Operation Manager', 'د عملیاتو مدیر', 'مدیر عملیات', 'To enhance daily tasks of travel agency', 'To enhance daily tasks of travel agency', 'د سفر د اژانس ورځني دندو ښه کول او د غوره خدماتو وړاندې کولو لپاره د ټیمونو همغږي.', 'بهبود وظایف روزانه آژانس مسافرتی و هماهنگی تیم‌ها برای ارائه بهترین خدمات.', 'team_99bd4cff5a9ef298.png', 'member', 1, 1, '2026-07-02 11:46:17'),
(3, 'Mohammad Aref', 'Mohammad Aref', 'محمد عارف', 'محمد عارف', 'Founder & CEO', 'Founder & CEO', 'بنیږ ایښودونکی او اجراییه رییس', 'مؤسس و مدیرعامل', 'With over 20 years in the travel industry, Mohammad founded Al Moqadas with a single purpose: to serve his community. What began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house trusted by thousands.', 'With over 20 years in the travel industry, Mohammad founded Al Moqadas with a single purpose: to serve his community. What began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house trusted by thousands.', 'د سفر صنعت کې له ۲۰ کلونو څخه د زیاتې تجربې سره، محمد المققدس د یو هدف سره تاسیس کړ: د خپل ټولنې خدمت کول.', 'با بیش از ۲۰ سال تجربه در صنعت مسافرت، محمد المققدس را با یک هدف تأسیس کرد: خدمت به جامعه خود.', '', 'lead', 1, 1, '2026-07-02 13:35:24'),
(4, 'Najibullah Sadat', 'Najibullah Sadat', 'نجیب الله سادات', 'نجیب‌الله سادات', 'Operations Director', 'Operations Director', 'د عملیاتو رییس', 'مدیر عملیات', '', '', '', '', '', 'member', 2, 1, '2026-07-02 13:35:24'),
(5, 'Zahra Ahmadi', 'Zahra Ahmadi', 'زهرا احمدي', 'زهرا احمدی', 'Visa & Documentation Lead', 'Visa & Documentation Lead', 'د ویزې او اسنادو مسؤله', 'مسئول امور ویزا و اسناد', '', '', '', '', '', 'member', 3, 1, '2026-07-02 13:35:24'),
(6, 'Karim Yousafi', 'Karim Yousafi', 'کریم یوسفي', 'کریم یوسفی', 'Senior Travel Consultant', 'Senior Travel Consultant', 'لوړ پوړی د سفر مشاور', 'مشاور ارشد مسافرت', '', '', '', '', '', 'member', 4, 1, '2026-07-02 13:35:24');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `name_en` varchar(120) NOT NULL DEFAULT '',
  `name_ps` varchar(120) NOT NULL DEFAULT '',
  `name_fa` varchar(120) NOT NULL DEFAULT '',
  `position` varchar(120) DEFAULT NULL,
  `position_en` varchar(120) NOT NULL DEFAULT '',
  `position_ps` varchar(120) NOT NULL DEFAULT '',
  `position_fa` varchar(120) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `content_en` text DEFAULT NULL,
  `content_ps` text DEFAULT NULL,
  `content_fa` text DEFAULT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `avatar` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `name_en`, `name_ps`, `name_fa`, `position`, `position_en`, `position_ps`, `position_fa`, `content`, `content_en`, `content_ps`, `content_fa`, `rating`, `avatar`, `sort_order`, `active`, `created_at`) VALUES
(1, 'Ahmad', 'Ahmad', 'احمد', 'احمد', 'FLIGHT', 'FLIGHT', 'الوتنه', 'پرواز', 'Booked my emergency flight in minutes. Everything was instant.', 'Booked my emergency flight in minutes. Everything was instant.', 'د بیړني الوتنې ټکټ مې په څو دقیقو کې بک کړ. هرڅه سمدستي وو.', 'بلیط پرواز اضطراریام را در چند دقیقه رزرو کردم. همه چیز بسیار سریع بود.', 5, '', 0, 1, '2026-07-01 10:49:09'),
(2, 'Sara', 'Sara', 'سارا', 'سارا', 'HOTEL', 'HOTEL', 'هوټل', 'هتل', 'Got a luxury upgrade without even asking. Amazing experience.', 'Got a luxury upgrade without even asking. Amazing experience.', 'له غوښتونکي پرته مې لوکس اپګریډ ترلاسه کړ. ډېره ښه تجربه وه.', 'بدون درخواست، ارتقاء به هتل لوکس دریافت کردم. تجربه فوق‌العاده‌ای بود.', 5, '', 1, 1, '2026-07-01 10:49:09'),
(3, 'Omar', 'Omar', 'عمر', 'عمر', 'VISA', 'VISA', 'ویزه', 'ویزا', 'Visa process was smooth and fully guided.', 'Visa process was smooth and fully guided.', 'د ویزې پروسه ډېره اسانه او په بشپړه توګه لارښود شوې وه.', 'پروسه ویزا بسیار روان و با راهنمایی کامل انجام شد.', 5, '', 2, 1, '2026-07-01 10:49:09'),
(4, 'Ali', 'Ali', 'علی', 'علی', 'SUPPORT', 'SUPPORT', 'ملاتړ', 'پشتیبانی', '24/7 support actually responded in seconds.', '24/7 support actually responded in seconds.', 'د ۲۴ ساعته ملاتړ واقعیا په څو ثانیو کې ځواب ورکړ.', 'پشتیبانی ۲۴ ساعته واقعاً در عرض چند ثانیه پاسخ داد.', 5, '', 3, 1, '2026-07-01 10:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `timeline_items`
--

CREATE TABLE `timeline_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` varchar(20) NOT NULL DEFAULT '',
  `year_en` varchar(20) NOT NULL DEFAULT '',
  `year_ps` varchar(20) NOT NULL DEFAULT '',
  `year_fa` varchar(20) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `title_en` varchar(255) NOT NULL DEFAULT '',
  `title_ps` varchar(255) NOT NULL DEFAULT '',
  `title_fa` varchar(255) NOT NULL DEFAULT '',
  `text` text DEFAULT NULL,
  `text_en` text DEFAULT NULL,
  `text_ps` text DEFAULT NULL,
  `text_fa` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timeline_items`
--

INSERT INTO `timeline_items` (`id`, `year`, `year_en`, `year_ps`, `year_fa`, `title`, `title_en`, `title_ps`, `title_fa`, `text`, `text_en`, `text_ps`, `text_fa`, `sort_order`, `active`, `created_at`) VALUES
(1, '2010', '2010', '۲۰۱۰', '۲۰۱۰', 'Founded in Kabul', 'Founded in Kabul', 'په کابل کې تاسیس', 'تأسیس در کابل', 'Al Ekhlas opens its doors, offering Umrah packages and flight bookings to the local community.', 'Al Ekhlas opens its doors, offering Umrah packages and flight bookings to the local community.', 'الاخلاص خپلې دروازې پرانیستې، کورنۍ ټولنې ته د عمرې بستې او الوتنې بکینګ وړاندې کوي.', 'الاخلاص درهای خود را باز کرد و بسته‌های عمره و رزرو پرواز را به جامعه محلی ارائه داد.', 1, 1, '2026-07-02 13:35:24'),
(2, '2015', '2015', '۲۰۱۵', '۲۰۱۵', 'Hajj Operations Begin', 'Hajj Operations Begin', 'د حج عملیات پیل', 'شروع عملیات حج', 'Expanded into full Hajj packages, partnering with trusted hotels near the Haram in Mecca and Medina.', 'Expanded into full Hajj packages, partnering with trusted hotels near the Haram in Mecca and Medina.', 'د بشپړ حج بستو ته پراختیا، په مکه او مدینه کې د حرم سره نږدې معتبر هوټلونو سره مشارکت.', 'توسعه به بسته‌های کامل حج با همکاری هتل‌های معتبر نزدیک حرم در مکه و مدینه.', 2, 1, '2026-07-02 13:35:24'),
(3, '2020', '2020', '۲۰۲۰', '۲۰۲۰', 'Kam Air Excellence Award', 'Kam Air Excellence Award', 'د کام ایر د تعالی جایزه', 'جایزه تعالی کام ایر', 'Recognized by Kam Air for outstanding ticket sales performance and partnership reliability.', 'Recognized by Kam Air for outstanding ticket sales performance and partnership reliability.', 'د کام ایر لخوا د غوره ټکټ پلور فعالیت او د مشارکت اعتبار لپاره وپیژندل شو.', 'توسط کام ایر برای عملکرد برتر در فروش بلیط و قابلیت اطمینان مشارکت تقدیر شد.', 3, 1, '2026-07-02 13:35:24'),
(4, '2023', '2023', '۲۰۲۳', '۲۰۲۳', 'Regional Expansion', 'Regional Expansion', 'سیمه ییز پراختیا', 'توسعه منطقه‌ای', 'Added visa services and custom tours for Dubai, Istanbul, Malaysia, and Europe.', 'Added visa services and custom tours for Dubai, Istanbul, Malaysia, and Europe.', 'د دوبۍ، استانبول، مالیزیا او اروپا لپاره د ویزې خدمتونه او دودیز سفرونه اضافه شول.', 'خدمات ویزا و تورهای سفارشی برای دبی، استانبول، مالزی و اروپا اضافه شد.', 4, 1, '2026-07-02 13:35:24'),
(5, '2026', '2026', '۲۰۲۶', '۲۰۲۶', '50,000+ Pilgrims Served', '50,000+ Pilgrims Served', 'له ۵۰,۰۰۰ څخه زیاتو زائرانو ته خدمت', 'خدمت به بیش از ۵۰,۰۰۰ زائر', 'Today, Al Ekhlas proudly serves families across Afghanistan with a 100%% visa success record.', 'Today, Al Ekhlas proudly serves families across Afghanistan with a 100%% visa success record.', 'نن، الاخلاص په ویاړ سره د افغانستان په کورنیو خدمت کوي د ۱۰۰٪ ویزې بریالیتوب ریکارډ سره.', 'امروز، الاخلاص با افتخار به خانواده‌های سراسر افغانستان با رکورد ۱۰۰٪ موفقیت ویزا خدمت می‌کند.', 5, 1, '2026-07-02 13:35:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_ref` (`booking_ref`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_booking_ref` (`booking_ref`);

--
-- Indexes for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero_slides`
--
ALTER TABLE `hero_slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `page_sections`
--
ALTER TABLE `page_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeline_items`
--
ALTER TABLE `timeline_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `enquiries`
--
ALTER TABLE `enquiries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hero_slides`
--
ALTER TABLE `hero_slides`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `page_sections`
--
ALTER TABLE `page_sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timeline_items`
--
ALTER TABLE `timeline_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
