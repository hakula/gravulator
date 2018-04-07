<?php

/**
 * Convert string to array and preserve spaces.
 *
 * @param  string  $string
 * @return array
 */
function split_string(string $string) {
  // Pad string with | to preserve empty spaces representing empty columns
  $string = sprintf('|%s|', $string);

  // Split string into columns and remove carriage return if present
  $split_string = str_split($string);

  // Remove | delimiters
  array_shift($split_string);
  array_pop($split_string);

  return $split_string;
}

/**
 * Reindex an array by row.
 *
 * @todo Consolidate this and rows_to_columns into one function
 *
 * @param  array  $array
 * @return array
 */
function columns_to_rows(array $columns) {
  $rows = [];
  foreach($columns as $col_index => $column) {
    foreach($column as $row_index => $value) {
      $rows[$row_index][$col_index] = $value;
    }
  }
  return $rows;
}

/**
 * Reindex an array by column.
 *
 * @todo Consolidate this and columns_to_rows into one function
 *
 * @param  array  $array
 * @return array
 */
function rows_to_columns(array $rows) {
  $columns = [];
  foreach($rows as $row_index => $cols) {
    foreach($cols as $col_index => $value) {
      $columns[$col_index][$row_index] = $value;
    }
  }
  return $columns;
}