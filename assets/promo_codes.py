import random
import string

num_codes = 20
code_length = 6

codes = []
percentages = []
for i in range(num_codes):
  code = ''.join(random.choices(string.ascii_letters, k=code_length))
  percentage = random.uniform(0.05, 0.2) * 100
  percentage = round(percentage)
  codes.append(code)
  percentages.append(percentage)

query = "INSERT INTO promo (code, percent) VALUES\n"
query_values = []
for code, percentage in zip(codes, percentages):
  query_values.append(f"  ('{code}', {percentage}),")

query += '\n'.join(query_values)
query = query[:-1]
query += ';'

print(query)
