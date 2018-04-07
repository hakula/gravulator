<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GravityController extends Controller
{
    /**
     * Play view with form.
     */
    public function index()
    {
        return view('play');
    }

    /**
     * Submit handler for form.
     */
    public function run(Request $request)
    {
        // Remove carriage returns
        $input = preg_replace("/\r/", "", $request->input('textarea'));

        // Split array into rows using new line as delimiter
        $input = explode(PHP_EOL, $input);

        // Use row count as height
        $height = count($input);

        // Find widest row for width
        $width = array_reduce($input, function ($carry, $item) {
            $item = strlen($item);
            if ($item > $carry) {
                $carry = $item;
            }
            return  $carry;
        }, 0);

        // Create input grid, padding rows to match $width
        $input = array_map(function ($item) use ($width) {
            $item = str_split($item);
            return array_pad($item, $width, ' ');
        }, $input);

        // Convert input into a column oriented matrix
        $columns = rows_to_columns($input);

        // Apply gravity to each column
        foreach ($columns as $ci => $column) {
            // Account for empty rows
            $column = array_map(function($item) {
              return empty($item) ? ' ' : $item;
            }, $column);
            $columns[$ci] = $this->apply_gravity($column);
        }

        // Display input and output for comparison
        return view('result', [
          'input' => $input,
          'matrix' => columns_to_rows($columns),
        ]);
    }

    /**
     * Apply gravity rules to a single column.
     *
     * @param  array  $column
     * @return array
     */
    protected function apply_gravity(array $column)
    {
        $gravity_column = [];
        // Apply rules to columns with tables separate as they are more complicated
        if (in_array('T', $column)) {
            // Split column into segments using T as delimiter
            $segments = explode('T', implode('', $column));

            // Remove last item to avoid adding unnecessary table padding
            $last_segment = array_pop($segments);

            foreach ($segments as $si => $segment) {

                // Apply rules to each segment
                $gravity_segment = $this->gravulate_rocks(split_string($segment));

                // Add padding for table
                array_push($gravity_segment, ' ');

                // Remvoe spaces to make room for table padding
                while (count($gravity_segment) > strlen($segment)) {
                    // Because tables are immovable, remove spaces above stacks if needed
                    $row_index = array_search(' ', $gravity_segment);
                    if (is_integer($row_index)) {
                        unset($gravity_segment[$row_index]);
                    }
                }
                $segments[$si] = implode('', $gravity_segment);
            }



            // Apply rules to last segment and add back to segments array
            $last_segment = $this->apply_gravity(split_string($last_segment));
            array_push($segments, implode('', $last_segment));
            // Reconstruct column from segments and tables
            $gravity_column = split_string(implode('T', $segments));
        } else {
            // Apply rules to column
            $gravity_column = $this->gravulate_rocks($column);
        }
        return $gravity_column;
    }

    /**
     * Apply gravity rules to rocks in a column.
     *
     * @param  array  $column
     * @return array
     */
    protected function gravulate_rocks(array $column)
    {
        $gravity_column = [];
        $stack_height = 2;
        // Pluck all rocks from column
        $rocks = array_filter($column, function ($item) {
            return $item == '.';
        });
        // If there are rocks in the column then apply rules
        if (count($rocks)) {
            // Divide number of rocks by stack height to get total stacks in column
            $stacks = floor(count($rocks) / $stack_height);
            // Add stacks to column
            for ($i = 0; $i < $stacks; $i++) {
                array_push($gravity_column, ':', ' ');
            }
            // If there is one more rock left then add to column
            if (count($rocks) % $stack_height) {
                array_push($gravity_column, '.');
            }
            // Pad new column to height of original
            $gravity_column = array_pad($gravity_column, count($column), ' ');
        }
        // Reverse array so that column is not upside down
        return array_reverse($gravity_column);
    }
}
