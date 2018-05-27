using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using PnP_Universal.Models;

namespace PnP_Universal.Controllers
{
    [Produces("application/json")]
    [Route("api/Templates")]
    public class TemplatesController : Controller
    {
        private readonly PnPContext _context;

        public TemplatesController(PnPContext context)
        {
            _context = context;
        }

        // GET: api/Templates
        [HttpGet]
        public IEnumerable<Templates> GetTemplates()
        {
            return _context.Templates;
        }

        // GET: api/Templates/5
        [HttpGet("{id}")]
        public async Task<IActionResult> GetTemplates([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var templates = await _context.Templates.SingleOrDefaultAsync(m => m.Id == id);

            if (templates == null)
            {
                return NotFound();
            }

            return Ok(templates);
        }

        // PUT: api/Templates/5
        [HttpPut("{id}")]
        public async Task<IActionResult> PutTemplates([FromRoute] int id, [FromBody] Templates templates)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            if (id != templates.Id)
            {
                return BadRequest();
            }

            _context.Entry(templates).State = EntityState.Modified;

            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateConcurrencyException)
            {
                if (!TemplatesExists(id))
                {
                    return NotFound();
                }
                else
                {
                    throw;
                }
            }

            return NoContent();
        }

        // POST: api/Templates
        [HttpPost]
        public async Task<IActionResult> PostTemplates([FromBody] Templates templates)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            _context.Templates.Add(templates);
            try
            {
                await _context.SaveChangesAsync();
            }
            catch (DbUpdateException)
            {
                if (TemplatesExists(templates.Id))
                {
                    return new StatusCodeResult(StatusCodes.Status409Conflict);
                }
                else
                {
                    throw;
                }
            }

            return CreatedAtAction("GetTemplates", new { id = templates.Id }, templates);
        }

        // DELETE: api/Templates/5
        [HttpDelete("{id}")]
        public async Task<IActionResult> DeleteTemplates([FromRoute] int id)
        {
            if (!ModelState.IsValid)
            {
                return BadRequest(ModelState);
            }

            var templates = await _context.Templates.SingleOrDefaultAsync(m => m.Id == id);
            if (templates == null)
            {
                return NotFound();
            }

            _context.Templates.Remove(templates);
            await _context.SaveChangesAsync();

            return Ok(templates);
        }

        private bool TemplatesExists(int id)
        {
            return _context.Templates.Any(e => e.Id == id);
        }
    }
}