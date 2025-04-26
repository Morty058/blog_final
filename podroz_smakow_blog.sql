-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Kwi 2025, 22:58
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `podroz_smakow_blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_p` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `ingredients` text NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `topic_id`, `title`, `image`, `image_p`, `body`, `ingredients`, `published`, `created`) VALUES
(11, 30, 7, 'Gołąbki', '1709252229_golabkiSG.jpg', '1709252229_golabkiPost.jpg', '&lt;ul&gt;&lt;li&gt;Kapustę sparz i oddziel liście. Gotuj je w osolonej wodzie przez około 5 minut, aż będą miękkie. Ostudź i odsącz.&lt;/li&gt;&lt;li&gt;W dużej misce wymieszaj mięso mielone, cebulę, ryż, jajko, koncentrat pomidorowy, olej, s&oacute;l, pieprz i opcjonalnie natkę pietruszki.&lt;/li&gt;&lt;li&gt;Nał&oacute;ż około 2 łyżki farszu na każdy liść kapusty. Zawiń je, zaczynając od dolnej części liścia i zginając boki w środku, formując gołąbki.&lt;/li&gt;&lt;li&gt;Uł&oacute;ż gołąbki ciasno obok siebie w garnku lub dużym rondlu.&lt;/li&gt;&lt;li&gt;Zalej gołąbki bulionem tak, aby były dobrze przykryte.&lt;/li&gt;&lt;li&gt;Gotuj na małym ogniu pod przykryciem przez około 1,5 do 2 godzin, aż mięso będzie dobrze ugotowane, a kapusta miękka.&lt;/li&gt;&lt;li&gt;Podawaj gorące, najlepiej z ziemniakami lub puree z ziemniak&oacute;w.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Smacznego!&lt;/p&gt;', '1 główka białej kapusty\r\n500g mięsa mielonego\r\n1 cebula, drobno posiekana\r\n1 szklanka ugotowanego ryżu\r\n1 jajko\r\n2 łyżki koncentratu pomidorowego\r\n2 łyżki oleju\r\n2 szklanki bulionu warzywnego lub mięsnego\r\nSól i pieprz do smaku', 1, '2024-02-24 01:17:28'),
(12, 30, 7, 'Pierogi z kapustą i grzybami', '1709252202_pierogiSG.jpg', '1709252202_pierogiPost.jpg', '&lt;ul&gt;&lt;li&gt;Rozpocznij od przygotowania nadzienia. Jeśli używasz suszonych grzyb&oacute;w, namocz je wcześniej w ciepłej wodzie przez ok. 30 minut, a następnie odcedź i posiekaj.&lt;/li&gt;&lt;li&gt;Na patelni rozgrzej olej lub masło, dodaj posiekaną cebulę i podsmaż ją aż będzie miękka i lekko zrumieniona.&lt;/li&gt;&lt;li&gt;Dodaj posiekaną kapustę i grzyby do cebuli. Smaż, mieszając od czasu do czasu, aż kapusta będzie miękka i grzyby będą dobrze podsmażone. Dopraw solą i pieprzem do smaku. Opcjonalnie, dodaj posiekaną natkę pietruszki.&lt;/li&gt;&lt;li&gt;W międzyczasie przygotuj ciasto. W misce wymieszaj mąkę z jajkiem, solą i stopniowo dodawaj ciepłą wodę, wyrabiając elastyczne ciasto. Ciasto powinno być gładkie i nieprzyklejające się do rąk. Jeśli jest zbyt suche, dodaj więcej wody; jeśli jest zbyt wilgotne, dodaj więcej mąki.&lt;/li&gt;&lt;li&gt;Rozwałkuj ciasto na cienki placek na lekko opr&oacute;szonej mąką powierzchni. Wytnij krążki za pomocą szklanki lub foremki do pierog&oacute;w.&lt;/li&gt;&lt;li&gt;Nał&oacute;ż niewielką ilość nadzienia na każdy krążek ciasta. Zlep brzegi pieroga i dobrze je dociskaj, aby zapewnić szczelne zamknięcie.&lt;/li&gt;&lt;li&gt;Gotuj pierogi partiami w dużej ilości osolonego wrzątku przez około 3-5 minut, aż wypłyną na powierzchnię. Następnie odcedź je.&lt;/li&gt;&lt;li&gt;Podawaj gorące pierogi polane lekko podsmażoną cebulką i opcjonalnie z dodatkiem śmietany lub masła.&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;Smacznego!&lt;/p&gt;', 'Ciasto:\r\n2 szklanki mąki pszennej\r\n1 jajko\r\nOkoło 1/2 szklanki ciepłej wody\r\nSzczypta soli\r\n\r\nNadzienie:\r\n2 szklanki posiekanej kapusty (świeżej lub kiszonej, wcześniej odcedzonej)\r\n1 szklanka posiekanych suszonych grzybów (można użyć również świeżych, jeśli są dostępne)\r\n1 cebula, drobno posiekana\r\n2 łyżki oleju lub masła\r\nSól i pieprz do smaku', 1, '2024-02-25 01:15:45'),
(13, 30, 8, 'Pizza neapolitańska', '1709252579_pizzaneapol1.png', '1709252579_pizzaneapol.jpg', '&lt;ul&gt;&lt;li&gt;Rozpocznij od przygotowania ciasta. W misce wymieszaj mąkę i s&oacute;l. W osobnej misce rozpuść drożdże w letniej wodzie. Po chwili dodaj roztw&oacute;r drożdży do mąki i zagnieć ciasto. Możesz to zrobić ręcznie lub przy użyciu miksera z hakiem do ciasta, aż do momentu, gdy ciasto będzie elastyczne i gładkie. Nie wymagaj zbyt dużo mąki na stolnicy podczas wyrabiania ciasta.&lt;/li&gt;&lt;li&gt;Uformuj ciasto w kulkę, umieść je z powrotem w misce, przykryj ściereczką i pozostaw w ciepłym miejscu na około 8-12 godzin, aby wyrosło. Ciasto powinno podwoić swoją objętość.&lt;/li&gt;&lt;li&gt;Przygotuj sos pomidorowy: Wł&oacute;ż pomidory San Marzano do miski i rozgnieć je, dodając szczyptę soli. Sos powinien być gładki i nie zawierać dużych kawałk&oacute;w pomidor&oacute;w.&lt;/li&gt;&lt;li&gt;Po wyrośnięciu ciasta, podziel je na mniejsze kule i uformuj z nich kuleczki. Każdą kulę rozwałkuj na okrągłą pizzę o grubości około 0,3 cm. Pamiętaj, że klasyczna pizza neapolitańska ma cienkie brzegi i lekko podniesiony środek.&lt;/li&gt;&lt;li&gt;Na rozwałkowanym cieście rozprowadź sos pomidorowy, pozostawiając około 1 cm brzegi. Następnie dodaj kawałki mozzarelli i listki bazylii.&lt;/li&gt;&lt;li&gt;Rozgrzej piekarnik do maksymalnej temperatury, najlepiej około 450-500&deg;C, i umieść pizzę na gorącej powierzchni do pieczenia (np. na specjalnej pizzy kamiennej) lub na blasze wyłożonej pergaminem. Piecz przez około 90 sekund do 2 minut, aż brzegi ciasta i ser się zrumienią, a podstawa pizzy będzie chrupiąca.&lt;/li&gt;&lt;li&gt;Gdy pizza jest gotowa, wyjmij ją z piekarnika, skrop oliwą z oliwek i podawaj gorącą. Najlepiej jest spożyć pizzę neapolitańską zaraz po upieczeniu, gdy jest najświeższa i najsmaczniejsza.&lt;/li&gt;&lt;/ul&gt;', 'Składniki na ciasto:\r\n500 g mąki typu \"00\"\r\n325 ml wody\r\n3 g suchych drożdży lub 10 g świeżych drożdży\r\n10 g soli\r\n\r\nSkładniki na sos pomidorowy:\r\n400 g obranych pomidorów San Marzano (z puszki)\r\nSzczypta soli\r\n\r\nSkładniki do położenia na pizzę (opcjonalne):\r\nMozzarella di Bufala\r\nOliwa z oliwek extra vergine\r\nŚwieża bazylia', 1, '2024-02-25 01:16:43'),
(14, 30, 9, 'Burger', '1708979334_burgerSG.jpg', '1708979334_burgerPost.jpg', '&lt;p&gt;Quisque tincidunt elit ac eleifend blandit. Curabitur eget massa pretium, tristique augue dignissim, tristique ex. Aenean interdum fermentum ultrices. Suspendisse et mi luctus, faucibus augue nec, suscipit sapien. Donec volutpat diam ut lacus ornare, non pellentesque metus sollicitudin. Ut rhoncus orci non lorem pretium lobortis. Suspendisse ultricies eros quis scelerisque mattis.&lt;/p&gt;&lt;p&gt;Curabitur pulvinar volutpat justo sit amet euismod. Suspendisse bibendum eros ac lorem hendrerit, at rhoncus magna efficitur. Etiam ac vehicula quam. Pellentesque eget cursus nulla. Nulla non eros vitae libero luctus scelerisque sit amet quis augue. Phasellus magna ante, consequat vitae bibendum et, mollis nec nulla. Etiam facilisis laoreet justo, eget aliquet felis consequat a. Curabitur faucibus enim sit amet consequat pellentesque. Suspendisse commodo urna in ipsum interdum, eget tincidunt urna pretium. Phasellus nibh tortor, pulvinar id leo eu, pulvinar sodales erat. Integer facilisis gravida nulla in pulvinar. Maecenas ut facilisis augue. Aliquam nec felis vel neque facilisis cursus id ac ipsum. Aenean nisi elit, fringilla sed mollis quis, semper at elit.&lt;/p&gt;', '', 1, '2024-02-25 01:17:04'),
(15, 30, 10, 'Quesadilla', '1708979345_quesadillaSG.jpg', '1708979345_quesadillaPost.jpg', '&lt;p&gt;per inceptos himenaeos. Praesent aliquet tincidunt tortor, ut rutrum orci egestas id. Nunc ullamcorper molestie urna, a blandit lorem semper vitae. Donec et ante gravida, rhoncus lorem vel, placerat velit.&lt;/p&gt;&lt;p&gt;Duis scelerisque erat non fermentum pellentesque. Sed id ipsum neque. Aliquam pretium tincidunt mi ut volutpat. Maecenas eu dolor turpis. Aliquam rutrum sit amet massa a eleifend. Etiam aliquet nisi libero, in mollis sapien hendrerit eget. Fusce faucibus tortor et purus vulputate, at sagittis tortor dignissim. Phasellus id augue a ipsum dapibus ornare eget quis lectus. Nunc non bibendum eros. Vestibulum euismod, magna et consectetur vulputate, nisl ante bibendum mi, id varius enim velit id justo.&lt;/p&gt;&lt;p&gt;In justo elit, porttitor eget lectus quis, elementum condimentum turpis. Aenean lacinia, dolor sit amet efficitur mattis, est sapien vulputate lacus, ac lobortis mi dolor nec magna. Ut consequat elit in purus consequat, sed pulvinar metus egestas. Fusce purus diam, luctus eu lorem in, condimentum malesuada leo. Duis&lt;/p&gt;', '', 1, '2024-02-25 01:17:29'),
(16, 30, 11, 'Kebab', '1708979388_kebabSG.jpg', '1708979388_kebabPost.jpg', '&lt;p&gt;Sed egestas ligula sapien. Donec blandit felis ac sapien porttitor gravida. In quis lectus aliquet, ultrices ante ut, dictum nisl. Proin sodales in felis sit amet facilisis. Nunc vel tellus porttitor, rutrum augue et, rutrum eros. Praesent scelerisque fringilla libero non convallis. Morbi malesuada, mi at placerat rutrum, risus tellus sollicitudin dolor, eget pulvinar purus diam eget nisl. Duis euismod et velit eu pellentesque. Curabitur neque erat, hendrerit in nulla ac, accumsan hendrerit diam. Aenean ac lacus tellus. Nullam vitae purus in nunc sollicitudin scelerisque. Ut maximus neque id nibh mollis, quis sollicitudin erat malesuada. Nam vulputate dignissim tortor ac volutpat. Ut augue lectus, placerat quis pretium at, accumsan nec dolor.&lt;/p&gt;&lt;p&gt;Suspendisse quis purus augue. Cras elementum vestibulum ligula, non venenatis ex aliquet id. Integer ac lectus eget turpis interdum gravida ac eget quam. Vivamus lacinia porttitor cursus. Donec ex dolor, condimentum id tempus non, tristique eget mi. Mauris ut molestie erat. Praesent placerat vehicula egestas. Cras blandit eros sed ipsum lacinia, ut porttitor ante rhoncus. Morbi luctus velit eu malesuada efficitur. Fusce mollis ex odio, et hendrerit ipsum sollicit&lt;/p&gt;', '', 1, '2024-02-25 01:17:51'),
(22, 30, 8, 'Carbonara', '1708980746_carbonaraSG.jpg', '1708980746_carbonaraPost.jpg', '&lt;p&gt;Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas cursus urna id mauris cursus tristique. Cras sit amet luctus nibh, eu rhoncus dolor. Praesent urna ante, elementum at ligula congue, bibendum tincidunt enim. Morbi quis tempus orci. Maecenas at purus ac orci elementum molestie vel sed purus. Suspendisse mi dolor, consectetur in dolor sed, elementum vestibulum sapien. Phasellus quis sodales neque.&lt;/p&gt;&lt;p&gt;Curabitur neque dolor, elementum sed fermentum quis, mattis et enim. Pellentesque neque orci, tincidunt sagittis turpis in, egestas lacinia dolor. Pellentesque lacinia in magna sit amet suscipit. Donec convallis ipsum ut nisi hendrerit, sit amet facilisis libero efficitur. Suspendisse maximus urna eget justo pulvinar aliquam. Sed vestibulum pharetra pellentesque. Fusce in ipsum convallis, blandit ipsum in, vestibulum purus. Nunc ipsum nunc, luctus quis accumsan sed, dapibus nec elit. Maecenas id eleifend dolor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec maximus cursus commodo. Aenean suscipit sem id dui aliquet, ut pretium purus euismod. Curabitur ornare nisi ut lacinia bibendum. Nullam el&lt;/p&gt;', '', 1, '2024-02-26 20:52:26'),
(23, 30, 12, 'test', '1709235965_carbonaraSG.jpg', '1709235965_carbonaraPost.jpg', '&lt;p&gt;convallis fermentum orci, a bibendum dolor dignissim non. Nam non nulla eget leo rutrum vulputate vel ac ipsum. Praesent id nulla ut magna consectetur ultrices. Aliquam ac euismod erat, nec convallis diam. Donec tincidunt nec ipsum mattis vestibulum. Proin sodales nisi vel nisl tempor faucibus. Donec aliquet id turpis at mattis. Nullam luctus a sapien ut posuere. Praesent neque diam, commodo nec dui at, condimentum blandit est.&lt;/p&gt;&lt;p&gt;Suspendisse justo enim, congue ut velit vitae, consectetur egestas arcu. Nam lobortis dictum suscipit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam vulputate sit amet lacus at sollicitudin. Suspendisse non velit congue, pellentesque mi eu, pretium ipsum. Praesent id faucibus ipsum. Morbi tincidunt tortor quis fermentum dignissim. Pellentesque cursus, turpis et egestas dignissim, justo lectus dictum nisi, tincidunt condimentum erat sapien vel mauris. Cras lorem libero, lacinia eget arcu ac, semper eleifend ante. Done&lt;/p&gt;', '2 ząbki czosnku\r\n400ml wody\r\n2 jajka\r\n1 żółtko\r\nopakowanie makaronu spaghetti \r\nparmezan\r\nzaza', 1, '2024-02-29 19:35:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`) VALUES
(7, 'Polska', '<p>Polskie dania</p>'),
(8, 'Włochy', '<p>Włoskie dania</p>'),
(9, 'USA', '<p>Dania z USA</p>'),
(10, 'Meksyk', '<p>Meksykańskie dania</p>'),
(11, 'Bliski Wschód ', '<p>Dania z Bliskiego Wschodu</p>'),
(12, 'Azja', '<p>Dania Azjatyckie</p>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `admin`, `username`, `email`, `password`, `created_at`) VALUES
(30, 1, 'Admin', 'Admin@as.com', '$2y$10$8//2LCAGy7JU/jRCFUsaEuvUrzpFzu8B/TmkLIzQeJFd5OsRIrRim', '2024-02-24 01:16:00'),
(31, 0, 'Normal', 'new@test.com', '$2y$10$cPB9K0DegqRIJmL/lYXtYObP2b9TkF4E7WadATn8A89ESl.AiAl9G', '2024-02-26 15:30:28'),
(33, 1, 'Admin123', 'ad@dsa.com', '$2y$10$TMEZ1q8AaYcosdpNZazmoOrcuaNWFYzSlbggG2tjNEHdFHVjreet.', '2025-01-07 16:00:21'),
(36, 0, 'userPM', 'userrr@PM.com', 'sdgfsdfsd', '2024-02-24 01:16:00'),
(37, 0, 'Normalooo', 'new@tt.com', 'G123', '2025-02-23 02:47:37'),
(38, 0, 'Normaloasdoo', 'new@ttttt.com', 'G1das23', '2025-02-23 02:52:45'),
(39, 0, 'userrrr', 'user@usrrr.com', 'qweasdzxc', '2025-03-03 19:24:26'),
(41, 0, 'test2403', 'test2403@tst.com', '$2y$10$jYBSmAme4eSv.2llmo.BjO/hM/IVyL9Nx9GUeOYUdeLuPNR3/pJJy', '2025-03-24 22:41:45'),
(49, 0, 'abccc', 'abc@cbaaa.pl', '$2y$10$bEBr7RdiO6WD4ma2VeuWgu09kOMPGcgBzkZcim8RaKJC5z6MSHUNy', '2025-04-01 22:31:21'),
(50, 1, 'Admin2803', 'admn@test.com', '$2y$10$FBzzcYia.snA5H.MmLxMTezoVrBGIAwf.vL5nUAb1T9t6H9qXWVJu', '2025-03-28 18:48:31'),
(66, 0, 'tstststststst', 'tststst@tststst.pl', '$2y$10$gQ10BzFzoXZ1dYhYDtaeFOt0hrQsYsQeyuQd5b1Li6wQOhOSWmnDq', '2025-04-04 23:49:28'),
(70, 0, 'sdfs', 'dfg@dfg.pl', '$2y$10$ztHA19rs92/Y1gQCCfXSG.sAjTuyafCC3qHyS47mGBDh17hSDQfUe', '2025-04-05 00:41:37');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indeksy dla tabeli `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
