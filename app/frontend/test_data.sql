/**
RECOVERED FROM STATIC CONTENT
*/

INSERT INTO presentation (starred, presenter_name, conference_name, presenter_image) VALUES

('1', 'Peter Morville', 'Ubiquitous Information Architecture: A Framework for Cross-Channel Strategy', 'peter-morville.jpg'),
('0', 'Charles-Alain Roy', 'Les fonctionnalités avancées de Google Analytics à travers des exemples concrets', 'charles-alain-roy.jpg'),
('0', 'Denis Boudreau', 'SEO, Web mobile et accessibilité : Trinité du développement Web inclusif', 'denis-boudreault.jpg'),
('0', 'Stéphane Hamel', 'Web analytics : êtes-vous sur la bonne voie ?', 'stephane-hamel.jpg'),
('0', 'François Gaumond', 'Savoir engager un véritable dialogue multicanal', 'francois-gaumond.jpg'),
('0', 'Catherine Morissette', 'Le web et les vides juridiques: difficultés d’application', 'catherine-morissette.jpg'),
('0', 'Rémy Savard', 'Nouveaux APIs (HTML5/CSS3/JS)', 'remy-savard.jpg'),
('0', 'Daniel Lafrenière', 'On veut pas le sawère, on veut le wère !', 'daniel-lafreniere.jpg'),
('0', 'Nicolas Roberge', 'Les ingrédients du Web ubiquitaire', 'nicolas-roberge.jpg'),
('0', 'Isabelle Grenier', 'Le Festival d’été de Québec et les médias sociaux : informer et divertir des milliers d’amis', 'isabelle-grenier.jpg'),
('0', 'Jacques Warren', 'Les médias sociaux sont si peu sociaux', 'jacques-warren.jpg'),
('0', 'Mario Asselin', 'OpenGouv / OpenData : le mode résistance n’a plus sa place!', 'mario-asselin.jpg'),
('0', 'Michaël Carpentier', 'Être accessible c’est bien, être compris c\'est mieux : écrire pour le Web', 'michael-carpentier.jpg'),
('0', 'Rémi Prévost', 'Introduction à Ruby', 'remi-prevost.jpg'),
('0', 'Carl-Frédéric de Celles, Sébastien Provencher, Kim Auclair,  Albert Dang Vu', '***Panel :*** Entreprendre le Web, à Québec, aujourd\'hui.', 'panel-entrepreneuriat.jpg');



/**
TEST DATA
*/


INSERT INTO `presentation`
(`ordering`,
`starred`,
`presenter_name`,
`presenter_image`,
`presenter_resume`,
`conference_name`,
`conference_resume`,
`conference_goals`,
`tags`,
`website`,
`twitter_handle`)


VALUES 

(
NULL, 
TRUE,
'Madame ABC',
'isabelle-grenier.jpg',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Conférence ABC', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

1. test
1. test2

**Gras!**

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

1. test
1. test2

**Gras!**

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'test,ipsum,web', 
'http://www.web.com', 
'marcboivin'
),

(
NULL, 
FALSE,
'Madame ABC',
'remi-prevost.jpg',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Conférence GHI', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

|Beast|Armor|
-----------
|Cat|fur|
|Cow|Leather|

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

[link text here](link.address.here "link title here")

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'fur,link,ipsum', 
'http://www.web.com', 
'marcboivin'
),

(
NULL, 
TRUE,
'Monsieur XYZ',
'kim-auclair.jpg',
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Conférence ZYX sur le web!', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

# Titre 1
## Titre 2

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed semper posuere ligula in elementum. Cras ornare odio vitae arcu tincidunt tempus. Donec eget elementum dui. In hac habitasse platea dictumst. Nam convallis urna non est tempor auctor. Maecenas congue tristique lorem, ut bibendum leo euismod vitae. Etiam rhoncus consectetur vulputate. Aliquam mattis fermentum aliquet. Aenean tristique, augue vitae fermentum semper, justo elit ornare nisi, pretium porttitor nisi felis a elit. Vivamus id mi arcu, sed volutpat dui.

* test
* test2

_Italique!_

Duis pharetra laoreet velit non ultrices. Etiam tempus tellus in tellus eleifend blandit. Cras id lacus purus. Praesent fermentum ante nec arcu adipiscing ac rutrum nisi pellentesque. Nullam vitae arcu a ante fermentum laoreet. Nulla est urna, condimentum vel rhoncus non, ornare sit amet lorem. Nam fringilla scelerisque massa sed pulvinar. Morbi convallis quam quis arcu dictum ac elementum sapien ultricies. Nam eleifend dolor vitae nibh porta bibendum. Duis non erat sapien. Morbi tincidunt turpis vitae nisl semper sodales. Nulla felis dolor, tempor eget eleifend vel, ultricies ut turpis.', 
'test,internet', 
'http://www.web123.com', 
'marcboivin'
)

;