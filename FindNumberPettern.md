https://regexr.com/
https://stackoverflow.com/questions/3888865/c-sharp-regular-expressions-for-matching-abab-aabb-abb-aab-abac-an

**ABAB like pattern**  
(\w)(\w(?<!\1))\1\2  
(\w) match a word character (digit, letter...) and capture the match into backreference 1  
(\w...) match a word character (digit, letter...) and capture the match into backreference 2  
(?<!\1) assert that it is impossible to match the regex matched by capturing group number 1 with the match ending at this position (negative lookbehind)  
\1 match the same text as most recently matched by capturing group number 1  
\2 match the same text as most recently matched by capturing group number 2  
  
**Others patterns**  
AABB ==> (\w)\1(\w(?<!\1))\2  
ABB ==> (\w)(\w(?<!\1))\2  
AAB ==> (\w)\1(\w(?<!\1))  
ABAC ==> (\w)(\w(?<!\1))\1(\w(?<!\1|\2))  
ABCB ==> (\w)(\w(?<!\1))(\w(?<!\1|\2))\2  
