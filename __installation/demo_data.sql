-- Create test hierarchy
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #1', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #1.1', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #2', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #2.1', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #2.2', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #2.2.1', 'news_rubric');
INSERT INTO cms_objects (`title`, `type`) VALUES ('Rubric #2.2.2', 'news_rubric');

INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (0, 1, 1, 1, UNIX_TIMESTAMP(), 'rubric_1');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (0, 3, 1, 1, UNIX_TIMESTAMP(), 'rubric_2');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (1, 2, 1, 1, UNIX_TIMESTAMP(), 'rubric_1_1');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (2, 4, 1, 1, UNIX_TIMESTAMP(), 'rubric_2_1');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (2, 5, 1, 1, UNIX_TIMESTAMP(), 'rubric_2_2');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (5, 6, 1, 1, UNIX_TIMESTAMP(), 'rubric_2_2_1');
INSERT INTO cms_hierarchy (`parent_id`, `obj_id`, `ord`, `is_active`, `updatetime`, `uri`) VALUES (5, 7, 1, 1, UNIX_TIMESTAMP(), 'rubric_2_2_2');

