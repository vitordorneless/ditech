select b.dept_name as departamento, 
concat(c.first_name,' ',c.last_name) as nome_funcionario,
datediff(a.to_date,a.from_date) as dias_trabalhados 
from dept_emp a
inner join departments b on a.dept_no = b.dept_no
inner join employees c on a.emp_no = c.emp_no
where a.to_date is not null
order by dias_trabalhados desc, nome_funcionario asc
limit 10;

