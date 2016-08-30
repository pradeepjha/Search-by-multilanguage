We can use the global $language to know in which language you are. In Views, you can filter using "content:language -> current user language."

- in other way we can use 

hook_query_node_access_alter() - the code is there in repository

- Or else we can user Search Config module also
