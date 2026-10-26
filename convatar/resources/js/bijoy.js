const bijoyToUni = [
  // longest/conjunct patterns FIRST, order matters
  ['ÿ', 'ক্ষ'], ['¶', 'ন্ত'],
  // ... conjuncts ...
  ['K', 'ক'], ['L', 'খ'], ['M', 'গ'],
  ['v', 'া'], ['w', 'ি'], ['x', 'ী'],
  // ... full table ...
];

export function bijoyToUnicode(text) {
  let out = text;

  // 1. fix split vowels
  out = out.replace(/†([^\s])v/g, '$1ো').replace(/†([^\s])Š/g, '$1ৌ');

  // 2. apply mapping table
  for (const [b, u] of bijoyToUni) out = out.split(b).join(u);

  // 3. reorder pre-base vowel signs: "ি" + consonant  →  consonant + "ি"
  out = out.replace(/([িেৈ])((?:[ক-হড়ঢ়য়]্)*[ক-হড়ঢ়য়])/g, '$2$1');

  return out;
}