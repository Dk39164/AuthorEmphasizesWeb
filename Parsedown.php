
<?php
# Parsedown library for Markdown to HTML
class Parsedown {
    const version = '1.7.4';

    function text($text) {
        $Elements = $this->textElements($text);
        $markup = $this->elements($Elements);
        return $markup;
    }

    protected function textElements($text) {
        $lines = explode("
", $text);
        return $this->linesElements($lines);
    }

    protected function linesElements(array $lines) {
        $Elements = array();
        foreach ($lines as $line) {
            $line = rtrim($line, "");
            if (preg_match('/^#{1,6}\s*(.+)/', $line, $matches)) {
                $level = strlen(explode(' ', $line)[0]);
                $Elements[] = array('name' => 'h' . $level, 'text' => trim($matches[1]));
            } elseif (preg_match('/^\*\s*(.+)/', $line, $matches)) {
                $Elements[] = array('name' => 'ul', 'handler' => 'elements', 'text' => array(array('name' => 'li', 'text' => $matches[1])));
            } elseif (preg_match('/^>\s*(.+)/', $line, $matches)) {
                $Elements[] = array('name' => 'blockquote', 'text' => $matches[1]);
            } elseif (preg_match('/^```/', $line)) {
                // skip code block (not implemented)
            } else {
                $text = htmlspecialchars($line);
                $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
                $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
                $text = preg_replace('/`(.+?)`/', '<code>$1</code>', $text);
                $Elements[] = array('name' => 'p', 'text' => $text);
            }
        }
        return $Elements;
    }

    protected function elements(array $Elements) {
        $markup = '';
        foreach ($Elements as $Element) {
            $markup .= $this->element($Element);
        }
        return $markup;
    }

    protected function element(array $Element) {
        $markup = "<{$Element['name']}>";
        if (isset($Element['handler']) && $Element['handler'] === 'elements') {
            foreach ($Element['text'] as $sub) {
                $markup .= $this->element($sub);
            }
        } else {
            $markup .= $Element['text'];
        }
        $markup .= "</{$Element['name']}>
";
        return $markup;
    }
}
?>
