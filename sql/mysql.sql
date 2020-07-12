# phpMyAdmin MySQL-Dump
# http://phpwizard.net/phpMyAdmin/
#
# Serveur: localhost Base de données: phpdig

# --------------------------------------------------------
#
# Structure de la table 'engine'
#

CREATE TABLE digmod_engine (
   spider_id mediumint(9) DEFAULT '0' NOT NULL,
   key_id mediumint(9) DEFAULT '0' NOT NULL,
   weight smallint(4) DEFAULT '0' NOT NULL,
   KEY key_id (key_id)
);


# --------------------------------------------------------
#
# Structure de la table 'keywords'
#

CREATE TABLE digmod_keywords (
   key_id mediumint(9) NOT NULL auto_increment,
   twoletters char(2) NOT NULL,
   keyword varchar(64) NOT NULL,
   PRIMARY KEY (key_id),
   UNIQUE KEY key_id (key_id),
   UNIQUE keyword (keyword),
   KEY twoletters (twoletters)
);


# --------------------------------------------------------
#
# Structure de la table 'sites'
#

CREATE TABLE digmod_sites (
   site_id mediumint(9) NOT NULL auto_increment,
   site_url varchar(127) NOT NULL,
   upddate timestamp(14),
   username varchar(32),
   password varchar(32),
   port smallint(6),
   locked tinyint(1) DEFAULT '0' NOT NULL,
   PRIMARY KEY (site_id),
   UNIQUE KEY (site_id)
);


# --------------------------------------------------------
#
# Structure de la table 'spider'
#

CREATE TABLE digmod_spider (
   spider_id mediumint(9) NOT NULL auto_increment,
   file varchar(127) NOT NULL,
   first_words text NOT NULL,
   upddate timestamp(14),
   md5 varchar(50),
   site_id mediumint(9) DEFAULT '0' NOT NULL,
   path varchar(127) NOT NULL,
   num_words int(11) DEFAULT '1' NOT NULL,
   last_modified timestamp(14),
   filesize int(11) DEFAULT '0' NOT NULL,
   PRIMARY KEY (spider_id),
   UNIQUE KEY spider_id (spider_id),
   KEY site_id (site_id)
);


# --------------------------------------------------------
#
# Structure de la table 'tempspider'
#

CREATE TABLE digmod_tempspider (
   file text NOT NULL,
   id mediumint(11) NOT NULL auto_increment,
   level tinyint(6) DEFAULT '0' NOT NULL,
   path text NOT NULL,
   site_id mediumint(9) DEFAULT '0' NOT NULL,
   indexed tinyint(1) DEFAULT '0' NOT NULL,
   upddate timestamp(14),
   error tinyint(1) DEFAULT '0' NOT NULL,
   PRIMARY KEY (id),
   UNIQUE KEY id (id),
   KEY site_id (site_id)
);

# --------------------------------------------------------
#
# Structure de la table 'excludes'
#
CREATE TABLE digmod_excludes (
   ex_id mediumint(11) NOT NULL auto_increment,
   ex_site_id mediumint(9) NOT NULL,
   ex_path text NOT NULL,
   PRIMARY KEY (ex_id),
   UNIQUE KEY ex_id (ex_id),
   KEY ex_site_id (ex_site_id)
);

# --------------------------------------------------------
#
# Structure de la table 'logs'
#
CREATE TABLE digmod_logs (
  l_id mediumint(9) NOT NULL auto_increment,
  l_includes varchar(255) NOT NULL default '',
  l_excludes varchar(127) default NULL,
  l_num mediumint(9) default NULL,
  l_mode char(1) default NULL,
  l_ts timestamp(14) NOT NULL,
  l_time float default '0' NOT NULL,
  PRIMARY KEY  (l_id),
  UNIQUE KEY l_id (l_id),
  KEY l_includes (l_includes),
  KEY l_excludes (l_excludes)
);