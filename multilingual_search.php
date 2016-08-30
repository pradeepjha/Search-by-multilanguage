function yourmodule_query_node_access_alter(QueryAlterableInterface $query) {
  $search = FALSE;
  $node = FALSE;

  // Even though we know the node alias is going to be "n", by checking for the
  // search_index table we make sure we're on the search page. Omitting this step will
  // break the default admin/content page.
  foreach ($query->getTables() as $alias => $table) {
    if ($table['table'] == 'search_index') {
      $search = $alias;
    }
    elseif ($table['table'] == 'node') {
      $node = $alias;
    }
  }

  // Make sure we're on the search page.
  if ($node && $search) {
    $db_and = db_and();
    // I guess you *could* use global $language here instead but this is safer.
    $language = i18n_language_interface();
    $lang = $language->language;

    $db_and->condition($node . '.language', $lang, '=');
    $query->condition($db_and);
  }
}
